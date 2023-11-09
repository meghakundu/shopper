@extends('layouts.app-master')
@section('content')
<form action="{{ route('home.updateStatus',$edit_orderList['id']) }}" method="POST" id="edit_form">
            @csrf
            @method('PUT')
       
            <div class="card-body">
              <input type="hidden" class="form-control" name="id" value="{{$edit_orderList['id']}}" />
              <div class="form-group">
                <input type="text" name="product_name" class="form-control mb-12 @error('product_name') is-invalid @enderror" id="exampleInputTitle" value="{{$edit_orderList['product_name']}}" disabled>
                @error('product_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Update Order Status:</label>
               <select name="status" id="order_status">
                <option value="0" @if($edit_orderList['status']==0) selected @endif>Pending</option>
                <option value="1"  @if($edit_orderList['status']==1) selected @endif>Completed</option>
               </select>
               @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
             @if(strpos($edit_orderList['delivery_type'], 'subscription'))
              <p class="title-subscribe">Edit Subscription</p>
              <p>Plan: {{$subscription_offers->subscription_type}}</p>
              <label>Starts At:</label>
              <input type="date" name="start_date" value="{{$subscription_offers->start_date}}" disabled/>
              <label>Ends At:</label>
              <input type="date" name="end_date" value="{{$subscription_offers->end_date}}"/> 
            @endif
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <form action="{{ route('home.cancelSubscribe',$edit_orderList['id']) }}" method="POST" id="edit_form">
            @csrf
            @method('PUT')
            <input type="submit" class="btn btn-danger" onclick="clicked(event)" value="Unsubscribe" />
       </form>
       <script>
        function clicked(e)
        {
            if(!confirm('Are you sure?')) {
                e.preventDefault();
            }
        }
       </script>
@endsection