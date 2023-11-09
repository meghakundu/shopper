@extends('layouts.app-master')
@section('content')
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
 @endif
 @if(session('error'))
<div class="alert alert-danger" role="alert">
{{ session('error') }}
</div>
 @endif
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Customer_Name</th>
                <th>Product_Name</th>
                <th>Delivery_type</th>
                <th>Destination</th>
                <th>Order_date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $ord_item)
            <tr>
                <td>{{$ord_item['company']['name']}}</td>
                <td>{{$ord_item['product_name']}}</td>
                <td>{{$ord_item['delivery_type']}}</td>
                <td>{{$ord_item['destination_postal_code']}}</td>
                <td>{{date('d M,y',strtotime($ord_item['created_at']))}}</td>
                <td>@if($ord_item['status']==0) Pending @else Completed @endif</td>
                <td class="action_row"><a href="/edit_status/{{$ord_item['id']}}">Edit</a>
                @if($ord_item['status']==0) <a href="/send-mail/{{$ord_item['id']}}"><button class="mail_btn">Reason for delay(via Email)</button></a>
                @else
                <a href="/send-invoice/{{$ord_item['id']}}">
                <button class="mail_btn">Send Invoice</button></a>
                @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Orders in queue:{{$count_orders_queued}}</h3>
    <button id="queued_btn">View Orders in Queue</button>
    
    <table id="queued_orders" class="display nowrap" style="width:100%;display:none">
        <thead>
            <tr>
                <th>Customer_Name</th>
                <th>Product_Name</th>
                <th>Vendor_Name</th>
                <th>Actual_wait_time(<7mins)</th>
                <th>Status</th>
                <th>Remarks send by customers(if any)</th>
            </tr>
        </thead>
        <tbody>
        @foreach($queued_data as $queued_item)
            <tr>
                <td>{{$queued_item['company']['name']}}</td>
                <td>{{$queued_item['product_name']}}</td>
                <td>{{$queued_item['company_name']}}</td>
                <td>{{$queued_item['actual_wait_time']}}</td>
                <td>@if($queued_item['status']==2) Added to Cart @endif</td>
                <td>{{$queued_item['reason']}}</td>
            </tr>
            @endforeach
        </tbody>
        </thead>
        </table>
        <h3>Limited Stock in vendors:</h3>
       @foreach($limited_stock_vendors->unique() as $item)
       {{$item['company_name']}} @if($loop->last!=1),@endif
        @endforeach
       <h3>Renewable Subscription offer:</h3>
       @foreach($popular as $value)
        @php
        $id = str_replace('article:',' ',$value);
        $subscrpt_name = App\Models\orders::select('product_name')->where('id',$id)->first();
        @endphp
        "{{$subscrpt_name['product_name']}}" is most renewed.
        @endforeach
        <script>
$(document).ready(function(){
  $("#queued_btn").click(function(){
    $("#queued_orders").toggle();
  });
});
</script>
@endsection
