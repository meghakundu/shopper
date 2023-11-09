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
                <th>Vendor_Name</th>
                <th>Product_Name</th>
                <th>Current Stock</th>
                <th>Total Stock</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($stockList as $stock_item)
            <tr>
                <td>{{$stock_item['company_name']}}</td>
                <td>{{$stock_item['product_name']}}</td>
                <td>@if($stock_item['status']==1){{$stock_item['stock']-$stock_item['qty']}} @elseif($stock_item['status']==2) Item in Cart({{$stock_item['qty']}}) @else {{$stock_item['stock']}} @endif</td>
                <td>{{$stock_item['stock']}}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container mt-4">
            <h2 class="mb-5 text-center">Connect with Vendors using Social media Share</h2>
            {!! $shareComponent !!}
        </div>
@endsection
