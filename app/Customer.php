<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table='customers';
    protected $fillable=['name','image','mobile','email','address','city','country','status'];
}
