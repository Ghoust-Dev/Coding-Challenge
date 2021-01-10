<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


use function Psy\debug;

class ProductController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
            'categorie_id' => 'required',
            'price' => 'required',
            'image' => 'required'
        ]);

        if($validate->fails()){
            return response()->json(['status'=>false,'error'=>$validate->errors()]);
        }

        $image = $request->image;
        $newImage = time().$image->getClientOriginalName();
        $image->move('uploads/products/images',$newImage);

        
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'categorie_id' => $request->categorie_id,
            'sub_categorie_id' => $request->sub_categorie_id,
            'price' => $request->price,
            'image' => 'uploads/products/images/'.$newImage
        ]);

        return response()->json(['status'=>true,'message'=>'The product has been added']);

    }

    public function show(Product $product,$filterName)
    {
        $product = Product::orderBy($filterName, 'asc')->get();

        return response()->json(['status'=>true,'products'=>$product]);
    }

    public function showProduct($id){
        $product = Product::find($id);
        
        return response()->json(['status'=>true,'product'=>$product]);
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
            'categorie_id' => 'required',
            'price' => 'required',
            'image' => 'required'
        ]);

        if($validate->fails()){
            return response()->json(['status'=>false,'error'=>$validate->errors()]);
        }

        $contains = Str::contains($request->image, 'uploads/products/images');
        
        if(!$contains){
            $image = $request->image;
            $newImage = time().$image->getClientOriginalName();
            $image->move('uploads/products/images',$newImage);            
            $product->image = 'uploads/products/images/'.$newImage;
        }        

        $product->name = $request->name;
        $product->description = $request->description;
        $product->categorie_id = $request->categorie_id;
        $product->price = $request->price;

        $product->save();

        return response()->json(['status'=>true,'message'=>'The product has been updated']);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json(['message'=>'The product has been deleted']);
    }
}
