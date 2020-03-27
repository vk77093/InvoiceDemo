@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Customer Here</div>
                <div class="card-body">
<form action="{{ route('product.store') }}" method="POST">
@csrf
Product Name*: <input type="text" name="name" class="form-control" required />
Price*: <input type="text" name="price" class="form-control" required />
<br />
<input type="submit" value="Save Product" class="btn btn-primary" />
</form>
</div>


            </div>
        </div>
    </div>
</div>
@endsection
