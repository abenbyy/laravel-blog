<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\AddProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // echo "index product";
        //$products = Product::paginate(5);
        $search = $request->get('query');
        $products = Product::where('name','like','%'.$search.'%')->simplePaginate(5);
        
        // dd($products);
        return view('Product\index',[
            'products'=>$products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ProductRepository $repo)
    {
        //$repo = new ProductRepository(new Product());
        dd($repo->all());


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProductRequest $request)
    {
        // $validator = Validator::make($request->all(),[
        //     'name' => '',
        //     'price' => '',
        // ]);

        // if($validator->fails()){

        // }

        // $this->validate($request,[

        // ]);
        
        // $request->validate([
        //     //'name' => 'required|unique:products,name|min:10',
        //     'name' => [
        //         'required',
        //         'unique:products,name',
                
        //     ],
        //     'price' => 'required|integer|min:10000',
        // ]);

        
        $model = new Product();
        $model->name = $request->name;
        $model->price = $request->price;
        $model->product_type_id = rand(1,2);
        $model->save();

        return back()->with('message', 'Success insert'); //returns immediately to request page
        //return redirect('/') //redirects into other page
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with(['type'=> function ($query){
            $query->select(['id','name']);
        }])->find($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $id)
    {

        // example to hard delete data
        // $products = Product::onlyTrashed()->get();
        // $products = Product::withTrashed()->where('id', 11)->forceDelete();


        //$product = Product::find($id);
        $id->delete();

        return back();
    }
}
