<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $dates = [
        'deleted_at'
    ];
    protected $table='categories';
    protected $fillable=[
        'name',
        'description',
        'photo',
        'comments',

    ];

    public function item()
    {
        return $this->hasOne(Item::class,'category_id','id');
    }

    public function items()
    {
        return $this->hasMany(Item::class,'category_id','id');
    }


}
