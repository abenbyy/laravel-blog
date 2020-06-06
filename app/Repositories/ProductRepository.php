<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    
    protected $model = null;
    
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function all(){
        return $this->model->all();
    }
}
?>