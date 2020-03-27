@extends('layouts.pdf')

@section('content')
    <div class="clearfix">
        @if (config('invoices.logo_file') != '')
            <div class="text-center">
                <img src="{{ asset(config('invoices.logo_file')) }}" />
            </div>
        @endif

        <div class="text-center">
            <b>Invoice {{ $invoice->invoice_number }}</b>
            <br>
            {{ $invoice->invoice_date }}
        </div>
    </div>

    <div class="clearfix mt-3">
        <div class="float-left">
            <b>To</b>:
            {{ $invoice->customer->name }}
            <br /><br />

            <b>Address</b>:
            {{ $invoice->customer->address }}
            <br />
            @if ($invoice->customer->postcode != '')
                ,
                {{ $invoice->customer->postcode }}
            @endif
            , {{ $invoice->customer->city }}
            @if ($invoice->customer->state != '')
                ,
                {{ $invoice->customer->state }}
            @endif
            , {{ $invoice->customer->country }}

            @if ($invoice->customer->phone != '')
                <br /><br /><b>Phone</b>: {{ $invoice->customer->phone }}
            @endif
            @if ($invoice->customer->email != '')
                <br /><br /><b>Email</b>: {{ $invoice->customer->email }}
            @endif

            @if ($invoice->customer->customer_fields)
                @foreach ($invoice->customer->customer_fields as $field)
                    <br /><br /><b>{{ $field->field_key }}</b>: {{ $field->field_value }}
                @endforeach
            @endif
        </div>

        <div class="float-right">
            <b>From</b>: {{ config('invoices.seller.name') }}
            <br /><br />
            <b>Address</b>: {{ config('invoices.seller.address') }}
            @if (config('invoices.seller.email') != '')
                <br /><br />
                <b>Email</b>: {{ config('invoices.seller.email') }}
            @endif
            @if (is_array(config('invoices.seller.additional_info')))
                @foreach (config('invoices.seller.additional_info') as $key => $value)
                    <br /><br />
                    <b>{{ $key }}</b>: {{ $value }}
                @endforeach
            @endif
        </div>
    </div>

    <div class="clearfix mt-3">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="text-center"> # </th>
                <th class="text-center"> Product </th>
                <th class="text-center"> Qty </th>
                <th class="text-center"> Price ({{config('invoices.currencyINR')}})</th>
                <th class="text-center"> Total ({{config('invoices.currencyINR')}})</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($invoice->invoice_items as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-center">{{ $item->price }} </td>
                    <td class="text-center">{{ number_format($item->quantity * $item->price, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <!-- <div class="clearfix mt-3">
        <table class="float-right table tbl-total">
            <tbody>
            @if ($invoice->tax_percent > 0)
                <tr>
                    <th class="text-right">Sub Total:</th>
                    <td class="text-left">
                        {{ number_format($invoice->total_amount, 2) }}
                    </td>
                </tr>
                <tr>
                    <th class="text-right">Tax:</th>
                    <td class="text-left">
                        {{ $invoice->tax_percentage }}%
                </tr>
                <tr>
                    <th class="text-right">Tax Amount:</th>
                    <td class="text-left">
                        {{ number_format($invoice->total_amount * $invoice->tax_percentage / 100, 2) }}
                    </td>
                </tr>
            @endif
            <tr>
                <th class="text-right">Grand Total:</th>
                <td class="text-left">
                    @if ($invoice->tax_percent > 0)
                        {{ number_format($invoice->total_amount * (1 + $invoice->tax_percentage / 100), 2) }}
                    @else
                        {{ number_format($invoice->total_amount, 2) }}
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div> -->
    <div class="row clearfix" style="margin-top:20px">
        <div class="col-md-12">
            <div class="float-right col-md-5">
                <table class="table table-bordered table-hover" id="tab_logic_total">
                    <tbody>
                    <tr>
                        <th class="text-center" width="60%">Sub Total ({{config('invoices.currencyINR')}})</th>
                        <td class="text-center">{{ number_format($invoice->total_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th class="text-center">Tax</th>
                        <td class="text-center">{{ $invoice->tax_percentage }}%</td>
                    </tr>
                    <tr>
                        <th class="text-center">Tax Amount ({{config('invoices.currencyINR')}})</th>
                        <td class="text-center">{{ number_format($invoice->total_amount * $invoice->tax_percentage / 100, 2) }}</td>
                    </tr>
                    <tr>
                        <th class="text-center">Grand Total ({{config('invoices.currencyINR')}})</th>
                        <td class="text-center">{{ number_format($invoice->total_amount + ($invoice->total_amount * $invoice->tax_percentage / 100), 2) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="clearfix mt-3">
        {{ config('invoices.footer_text') }}
    </div>
@endsection
