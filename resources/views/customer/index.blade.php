@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Customer Data</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! <a href="{{route('customer.create')}}">
                      <button class="btn btn-primary">ADD More Customer</button></a>
<table class="table table-stripped">
<tr>
  <th>S.No.</th>
  <th>Name</th>
  <th>Address</th>
  <th>Postcode</th>
  <th>City</th>
  <th>State</th>
  <th>Phone</th>
  <th>Email</th>


</tr>
  @foreach($customers as $customer)
<tr>

  <td>{{$customer->id}}</td>
  <td>{{$customer->name}}</td>
  <td>{{$customer->address}}</td>
  <td>{{$customer->postcode}}</td>
  <td>{{$customer->city}}</td>
  <td>{{$customer->state}}</td>
  <td>{{$customer->phone}}</td>
  <td>{{$customer->email}}</td>
</tr>
@endforeach
</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
