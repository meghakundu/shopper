@extends('layouts.app-master')
@section('content')
<form action="/update-transactions/{{$transactions['id']}}" method="POST" id="edit_form">
            @csrf
            @method('PUT')
       
            <div class="card-body">
              <input type="hidden" class="form-control" name="id" value="{{$transactions['id']}}" />
              <div class="form-group">
              <label>Paid To:</label>
                <input type="text" name="bank_name" class="form-control mb-12 @error('bank_name') is-invalid @enderror" id="exampleInputTitle" value="{{$transactions['bankData']['name']}}" disabled>
              </div>
              <div class="form-group mb-12">
                <label>Refund Type:</label>
               <select name="refund_type" id="ddlSuggestion" onchange="GetSelectedTextValue()">
                <option value="full-refund">Full Refund</option>
                <option value="partial-refund">Partial Refund</option>
               </select>
              </div>
              <div class="form-group">
                <label>Payable Amount:</label>
              <input type="hidden" name="balance" value="{{$transactions['bankData']['balance']}}"/>
              <input type="text" name="amount" value="{{$transactions['amount']}}" disabled/>
              </div>
              <div class="form-group" id="txtComments" style="display: none;" >
              <label>Partial Refund Amount:</label>
              <input type="text" name="refund_amount">
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Repay</button>
            </div>
        </form>
        <script type="text/javascript">
            function GetSelectedTextValue() {
                var v=document.getElementById("ddlSuggestion");
          var v1=document.getElementById("txtComments");
          if(v.value=="partial-refund")
          {
             v1.style.display='block';
          }
          else
          {
             v1.style.display='none';
          }
         }
            </script>
@endsection