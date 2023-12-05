<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'category_id', 'product_name', 'description', 'sale_price', 'image',
    ];
    protected $appends = ['image_path', 'profit'];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    public function sales()
    {
    return $this->belongsToMany(Sale::class, 'product_sale', 'product_id', 'sale_id');
    }
    public function purchases()
    {
        return $this->belongsToMany(Purchase::class, 'product_purchase', 'product_id', 'purchase_id');
    }
    public function getImagePathAttribute()
    {
        return asset('upload/items/' . $this->image);
    }
    public function getProfitAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;
        return $profit;
    }
}
