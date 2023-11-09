<?php
namespace App\Http\Controllers;

use App\Services\SpellsService;
use Carbon\Carbon;
use App\Services\DemoOne;
use App\Models\orders;
use App\Models\blog;
use App\Models\subscriptions;
use App\Models\User;
use App\Models\transaction;
use App\Models\banks;
use App\Models\queue;
use App\Models\vendors;
use App\Models\spell;
use PDF;
use Mail;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
   /* public function index(SpellsService $gumroad)
    {  
       $spellsList = $gumroad->getSpells();
       print_r($spellsList);
      foreach($spellsList as $item){
            $spell = new spell();
            $spell->name = $item->name;
            $spell->description = $item->description;
            $spell->save();
      }
    }*/
    public function index(){
        return view('home.index');
    }

    public function showOrders(){
        if(Auth::user()){
        $data = orders::with(['company'])->where('status',1)
        ->orwhere('status',0)->get();
        $orders_queue = orders::select('orders.id')
                            ->join('vendors','vendors.order_id','=','orders.id')
                            ->join('queue','queue.vendor_id','=','vendors.id')
                            ->where('orders.status',2)
                            ->get();
        $count_orders_queued = $orders_queue->count();
        $queued_data = orders::with(['company'])
        ->join('vendors','vendors.order_id','=','orders.id')
        ->join('queue','queue.vendor_id','=','vendors.id')
        ->join('feedbacks','queue.id','=','feedbacks.queue_id')
        ->where('orders.status',2)
        ->get();
        
        
        $limited_stock_vendors = vendors::select('vendors.company_name')
        ->join('orders','vendors.order_id','=','orders.id')
        ->where('orders.status',2)
        ->where('vendors.stock',1)
        ->get();

        $subscription_offers = subscriptions::all();
        if(isset($subscription_offers)){
        $redis = Redis::connection();
        $popular = $redis->zRevRange('articleViews',0,1);  
       }
        return view('home.orders',compact('data','popular','count_orders_queued','queued_data','limited_stock_vendors'));
        }else{
            return redirect('/');
        }
        
    }

    public function editOrders(Request $request,$id){
        $edit_orderList = orders::where('id',$id)->first();
        $subscription_offers = subscriptions::where('order_id',$id)->first();
        if(isset($subscription_offers)){
           // echo "123";
            $this->id = $id;
            $redis = Redis::connection();
            if($redis->zScore('articleViews','article:'.$id)){
                $redis->pipeline(function ($pipe){
                    $pipe->zIncrBy('articleViews',1,'article:'.$this->id);
                    $pipe->incr('article:'.$this->id.'views');
                });
            }else{
                $views = $redis->incr('article:'.$this->id.'views');
                $redis->zIncrBy('articleViews',$views,'article:'.$this->id);
            }
            $views = $redis->get('article:'.$this->id.'views');
           
        }
        return view('home.edit-order',compact('edit_orderList','subscription_offers'));
    }

    public function updateOrders(Request $request,$id){
        orders::where('id',$id)->update([
            'status' => $request->status
        ]);
        $end_date_item =  subscriptions::select('end_date')->where('order_id',$id)->first();
        if($request->end_date > $end_date_item->end_date){
        subscriptions::where('order_id',$id)->update([
            'end_date' => $request->end_date,
            'status'=>2
        ]);
         }elseif($request->end_date <= $end_date_item->end_date){
            subscriptions::where('order_id',$id)->update([
                'end_date' => $request->end_date,
                'status'=>1
            ]);
         }
        return redirect('/orders')->with('success','Order Status updated successfully.');

    }

    public function sendMail($id)
    {
        $mailData = [
            'title' => 'Mail from Homeshoppee',
            'body' => 'We regret the inconvienience caused for delay in order.Hopefully we will be able to complete your order in a short while.'
        ];
        $reciever_mailid = User::select('email')->join('orders','orders.customer_id','=','users.id')
        ->where('orders.id',$id)->first();
        Mail::to(''.$reciever_mailid->email.'')->send(new DemoMail($mailData));
        return redirect('/orders')->with('success','Email Sent successfully.');  
       // dd("Email is sent successfully.");
    }
    public function sendMailWithPDF($id)
    {   
        $reciever_mailid = User::select('email')->join('orders','orders.customer_id','=','users.id')
       ->where('orders.id',$id)->first();
        $data["email"] = $reciever_mailid->email;
        $data["title"] = "Welcome to HomeShoppee";
        $data["body"] = "Your invoice is attached in mail";
        $data["items"] = orders::where('id',$id)->first();
        $pdf = PDF::loadView('invoice_pdf',$data);

        Mail::send('mail', $data, function ($message) use ($data, $pdf) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "invoice.pdf");
        });

        return redirect('/orders')->with('success','Email Sent successfully.');  
      
    }

    public function cancelSubscription($id){
        
        subscriptions::where('order_id',$id)->update([
            'end_date' => now(),
            'status'=>0
        ]);
        orders::where('id',$id)->update([
            'status'=>0
        ]);
        return redirect('/orders')->with('success','Subscription Cancelled.');  
      
    }

    public function transactionList(){
        $transactions = transaction::with(['orderData','paymentTypes','bankData'])->get();
        return view('transaction.index',compact('transactions'));
    }
   
    public function refundPayment($id){
        $transactions = transaction::with(['orderData','paymentTypes','bankData'])->where('id',$id)->first();
        return view('transaction.refund_payment',compact('transactions'));
    }

    public function updateTransaction(Request $req,$id){
        if($req->refund_type=='partial-refund'){
            banks::where('transaction_id',$id)->update([
                'balance' => $req->balance+$req->refund_amount,
                'status' => 1
            ]);
            transaction::where('id',$id)->update([
                'status' => 1,
                'amount'=> 0.029 * (($req->amount)-($req->refund_amount))
            ]);
        }
       else{
        banks::where('transaction_id',$id)->update([
            'balance' => $req->balance+$req->amount,
            'status' => 1
        ]);
        transaction::where('id',$id)->update([
            'status' => 1
        ]);
       }
        return redirect('/manage-transactions')->with('success','Refund amount added');
    }
    
    public function showStocks(){
        $stockList = vendors::select('vendors.company_name','orders.status','orders.product_name','vendors.stock','orders.qty')
                     ->join('orders','vendors.order_id','=','orders.id')
                     ->where('orders.status','>','0')
                     ->get();
        $shareComponent = \Share::page(
                        'https:\\shopper.test\stocks',
                        'View App',
                    )
                    ->facebook()
                    ->twitter()
                    ->linkedin()
                    ->whatsapp();
        return view('stocks_index',compact('stockList','shareComponent'));
    }

    public function showBlogs(){
        $blogsList = blog::all();
        $blogs_per_month = blog::select('name')->groupby('created_at')->get();
        
        return view('blogs',compact('blogsList','blogs_per_month'));
    }
   
}
