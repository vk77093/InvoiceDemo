@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Customer Here</div>
                <div class="card-body">
<form action="{{ route('customer.store') }}" method="POST">
@csrf
Name*: <input type="text" name='customer[name]' class="form-control" required />
Address*: <input type="text" name='customer[address]' class="form-control" required />
Postcode/ZIP: <input type="text" name='customer[postcode]' class="form-control" />
City*: <input type="text" name='customer[city]' class="form-control" required />
State: <input type="text" name='customer[state]' class="form-control" />
Country*:
<!-- <input type="text" name='customer[country]' class="form-control" required /> -->
<select class="form-control" name="customer[country]">
  <option value disabled="0">Please Select customer</option>
  @foreach($countries as $country)
  <option value="{{$country->title}}">
  {{$country->title}}  ({{$country->shortcode}})
  </option>
@endforeach
</select>
<br />
Phone: <input type="text" name='customer[phone]' class="form-control" />
Email: <input type="email" name='customer[email]' class="form-control" />
<br />
<b>Additional fields</b> (optional):
<br />
<table class="table table-bordered table-hover">
    <tbody>
    <tr>
        <th class="text-center" width="50%">Field</th>
        <th class="text-center">Value</th>
    </tr>
    @for ($i = 0; $i <= 3; $i++)
        <tr>
            <td class="text-center">
                <input type="text" name='customer_fields[{{ $i }}][field_key]' class="form-control" />
            </td>
            <td class="text-center">
                <input type="text" name='customer_fields[{{ $i }}][field_value]' class="form-control" />
            </td>
        </tr>
        <!-- <tr>
            <td class="text-center">
                <input type="text" name='customer_fields[filed_key]' class="form-control" />
            </td>
            <td class="text-center">
                <input type="text" name='customer_fields[filed_value]' class="form-control" />
            </td>
        </tr> -->
    @endfor
    </tbody>
</table>
<input type="submit" value="Save customer" class="btn btn-primary" />
</form>
</div>


            </div>
        </div>
    </div>
</div>
@endsection
