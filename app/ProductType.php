<?php

namespace App;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    public function product(){
        //return $this->hasMany('App\Models\Product')
        return $this->hasMany(Product::class);
    }
}
