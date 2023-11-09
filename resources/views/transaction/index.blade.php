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
                <th>Ordered By</th>
                <th>Product_Name</th>
                <th>Payment Mode</th>
                <th>Amount Payable</th>
                <th>Transaction Date</th>
                <th>Bank Balance</th>
                <th>Order Status</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $item)
            <tr>
                <td>{{$item['paymentTypes']['login_email']}}</td>
                <td>{{$item['orderData']['product_name']}}</td>
                <td>{{$item['paymentTypes']['name']}}</td>
                <td>{{$item['amount']}}</td>
                <td>{{date('d M,y',strtotime($item['updated_at']))}}</td>
                <td>@if($item['bankData']!= null){{$item['bankData']['balance']}}@endif</td>
                <td>@if($item['orderData']['status']==0) Cancelled/Pending @else Completed @endif</td>
                <td>@if($item['status']==0) Cancelled/Refund @else Completed @endif</td>
                <td>@if($item['orderData']['status']==0) <a href="/refund-transaction/{{$item['id']}}"><button class="mail_btn">Refund</button></a>
                @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection
