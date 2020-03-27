<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Invoice;
use App\Invoicesitem;
use App\Product;

class invoiceController2 extends Controller
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
      $customers=Customer::get()->unique();
      $products=Product::get()->unique();
      //$customers=Customer::pluck('name','id');
        return view('invoice.create2',compact('customers','products'));
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
    //$customer=Customer::create($request->customer);
      /* here for the second stage we are using the Invoice Number and
      tax save*/
    $invoice=Invoice::create($request->invoice);
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




return redirect('/home');
      //echo "we will contiue that work";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
