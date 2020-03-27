<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded=['id'];

    public function customer(){
      return $this->belongsTo('App\Customer');
    }
    public function invoice_items(){
      return $this->hasMany('App\Invoicesitem');
    }

    public function getTotalAmountAttribute(){
      $total_amount = 0;
      foreach ($this->invoice_items as $item) {
        $total_amount += $item->price  * $item->quantity;
      }

      return $total_amount;
    }
  }
