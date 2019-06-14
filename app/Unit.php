<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $dates = [
        'deleted_at'
    ];
    protected $table='units';
    protected $fillable=['name'];
}
