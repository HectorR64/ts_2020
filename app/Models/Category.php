<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name', 'slug','status','image'
    ];

    public function items(){
        return $this->hasMany('App\Models\Item');
    }
}
