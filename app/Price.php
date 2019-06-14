<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected  $table='prices';
    protected $fillable=['product_id','sale_prices','purchase_prices'];
}
