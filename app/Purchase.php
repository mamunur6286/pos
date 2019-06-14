<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table='purchases';
    protected $fillable=['purchase_no','purchase_date','supplier_id','item_id','quantity','price','discount','amount'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class,'item_id','id');
    }

}
