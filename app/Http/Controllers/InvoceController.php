<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Customer;
use App\Invoice;
use App\Invoicesitem;
use App\CustomerFiled;
class InvoceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $customers=Customer::all();
        return view('invoice.create',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // here we first call the Customer Table as
      // $request->customer bez we define at the crate form with aaray
    $customer=Customer::create($request->customer);
      /* here for the second stage we are using the Invoice Number and
      tax save*/
    $invoice=Invoice::create($request->invoice +['customer_id'=>$customer->id]);
/* here for the thrid satge we are going to save the item details */
for($i=0;$i<count($request->product);$i++){
  if(isset($request->qty[$i]) && isset($request->price[$i])){
    Invoicesitem::create([
      'invoice_id'=>$invoice->id,
      'name'=>$request->product[$i],
      'quantity'=>$request->qty[$i],
      'price'=>$request->price[$i],

    ]);
  }
}
/* here for the fourth stage where we are getting the
extra filed value for the invoice */


for ($i=0; $i < count($request->customer_fields); $i++) {
            if (isset($request->customer_fields[$i]['field_key']) && isset($request->customer_fields[$i]['field_value'])) {
                CustomerFiled::create([
                    'customer_id' => $customer->id,
                    'field_key' => $request->customer_fields[$i]['field_key'],
                    'field_value' => $request->customer_fields[$i]['field_value']
                ]);
            }
        }

return redirect('/home');
      //echo "we will contiue that work";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoce  $invoce
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice=Invoice::findOrFail($id);
        return view('invoice.show',compact('invoice'));
    }
    // that method for pdf Download
    public function download($id)
    {
        $invoice=Invoice::findOrFail($id);
        $pdf= \PDF::loadView('invoice.pdf',compact('invoice'));
      //echo "I will allow you to download the file in pdf";
      return $pdf->stream('invoice.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoce  $invoce
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoce $invoce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoce  $invoce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoce $invoce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoce  $invoce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoce $invoce)
    {
        //
    }
}
