<?php

namespace App\Models;

use App\ProductType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public function type(){
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }
}
