@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! <a href="{{route('invoice2.create')}}">
                      <button class="btn btn-primary">ADD More Invoice</button></a>
<table class="table table-stripped">
<tr>
  <th>Invoice Date</th>
  <th>Invoice Number</th>
  <th>Customer Name</th>
  <th>Total Amount</th>
  <th></th>


</tr>
  @foreach($invoice as $invoices)
<tr>

  <td>{{$invoices->invoice_date}}</td>
  <td>{{$invoices->invoice_number}}</td>
  <td>{{$invoices->customer->name}}</td>
  <td>{{number_format($invoices->total_amount,2)}}</td>
  <td><a href="{{route('invoice.show',$invoices->id)}}" class="btn btn-info btn-sm">View Invoice</a></td>
<td>
  <a href="{{route('invoice.download',$invoices->id)}}" class="btn btn-warning btn-sm">Download Invoice</a>
</td>

</tr>
@endforeach
</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
