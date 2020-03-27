@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Customer Data</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! <a href="{{route('product.create')}}">
                      <button class="btn btn-primary">ADD More Products</button></a>
<table class="table table-stripped">
<tr>
  <th>S.No.</th>
  <th>Name</th>
  <th>Price</th>
</tr>
  @forelse($products as $product)
<tr>
  <td>{{$product->id}}</td>
  <td>{{$product->name}}</td>
  <td>{{$product->price}}</td>
</tr>
@empty
<tr>
  <td colspan="2">Currently No Products</td>
</tr>
@endforelse
</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
