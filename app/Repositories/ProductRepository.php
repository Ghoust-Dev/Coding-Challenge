<?php

namespace App\Repositories;

use App\Product;
use Illuminate\Support\Str;

class ProductRepository
{
    public function orderBy($filterName)
    {
        return Product::orderBy($filterName, 'asc')->get();
    }

    public function create($request) {        

        $image = $request['image'];
        $newImage = time().$image->getClientOriginalName();
        $image->move('uploads/products/images', $newImage);


        Product::create(
            [
            'name' => $request['name'],
            'description' => $request['description'],
            'categorie_id' => $request['categorie_id'],
            'sub_categorie_id' => $request['sub_categorie_id'],
            'price' => $request['price'],
            'image' => 'uploads/products/images/'.$newImage
            ]
        );

    }

    public function find($id)
    {
        return Product::find($id);
    }

    public function update($request, $product)
    {
        $contains = Str::contains($request['image'], 'uploads/products/images');
        
        if(!$contains) {
            $image = $request['image'];
            $newImage = time().$image->getClientOriginalName();
            $image->move('uploads/products/images', $newImage);            
            $product->image = 'uploads/products/images/'.$newImage;
        }        

        $product->name = $request['name'];
        $product->description = $request['description'];
        $product->categorie_id = $request['categorie_id'];
        $product->price = $request['price'];

        $product->save();
    }

    public function delete($product)
    {
        $product->delete();
    }

    
}
