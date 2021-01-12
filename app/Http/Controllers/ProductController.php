<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function store(Request $request)
    {

        $data = $request->only([
            'name',
            'description',
            'categorie_id',
            'price',
            'image',
            'sub_categorie_id'
        ]);
            
        $result = ['status' => 200];

        try {
            $result['data'] = $this->productService->saveProduct($data);
        }catch(Exception $e){
            $result = [
                'status'=> 500,
                'error'=>$e->getMessage()
            ] ;
        }

        return response()->json($result,$result['status']);

    }

    public function show($filterName)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->productService->getProductsOrderBy($filterName);
        }catch(Exception $e){
            $result = [
                'status'=> 500,
                'error'=>$e->getMessage()
            ] ;
        }

        return response()->json($result,$result['status']);

    }

    public function showProduct($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->productService->getProductById($id);
        }catch(Exception $e){
            $result = [
                'status'=> 500,
                'error'=>$e->getMessage()
            ] ;
        }

        return response()->json($result,$result['status']);

    }

    public function update(Request $request, $id)
    {
        $data = $request->only([
            'name',
            'description',
            'categorie_id',
            'price',
            'image',
            'sub_categorie_id'
        ]);
            
        $result = ['status' => 200];

        try {
            $result['data'] = $this->productService->updateProduct($data,$id);
        }catch(Exception $e){
            $result = [
                'status'=> 500,
                'error'=>$e->getMessage()
            ] ;
        }

        return response()->json($result,$result['status']);
    }

    public function destroy($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->productService->deleteProduct($id);
        }catch(Exception $e){
            $result = [
                'status'=> 500,
                'error'=>$e->getMessage()
            ] ;
        }

        return response()->json($result,$result['status']);

    }
}
