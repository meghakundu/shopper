<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\DemoMail;
use App\Models\blog;
use Illuminate\Http\Request;
use Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
   
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {   
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $req)
    {
        //$email = new DemoMail();
       $blogData = blog::find($req->id);
       print_r("hello");
       //Mail::to('meghakundu808@gmail.com')->send($email);
      // \Share::page(url('/post/'))->facebook();  
      print_r(" <a href='https://www.facebook.com/sharer/sharer.php?u={$blogData['post_link']}'><button>Share with fb</button></a>");
      
    }
}
