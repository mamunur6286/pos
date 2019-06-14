<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table='invoices';
    protected $fillable=['invoice_no','invoice_date','customer_id','item_id','quantity','price','discount','amount'];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class,'item_id','id');
    }
}

