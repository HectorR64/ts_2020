<?php

namespace App\Models;


use App\Models\Client;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = [];
    protected $qtys = [
        'quantity' => 'array',
    ];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sale', 'sale_id', 'product_id')->withPivot('quantity');
    }
}
