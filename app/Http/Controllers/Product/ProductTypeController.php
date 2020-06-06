<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductType;

class ProductTypeController extends Controller
{
    public function show($id,$search){
        $type = ProductType::with(['product'=>function($query) use($search){
            $query->where('name','like','%'.$search.'%')->get(['id','name']);
        }])->find($id);
        return response()->json($type);
    }
}
