<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table='items';
    protected $fillable=[
        'category_id',
        'unit_id',
        'name',
        'description',
        'units',
        'photo',
        'comments',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category','category_id','id');
    }
    public function unit()
    {
        return $this->belongsTo('App\Unit','units','id');
    }

    public function price()
    {
        return $this->hasone(Price::class,'item_id','id');
    }

}
