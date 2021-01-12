<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function saveProduct($data)
    {
        
        $validate = Validator::make($data, [
                'name' => 'required',
                'description' => 'required',
                'categorie_id' => 'required',
                'price' => 'required',
                'image' => 'required'
            ]
        );        

        if($validate->fails()) {
            throw new InvalidArgumentException($validate->errors()->first());
        }

        $result = $this->productRepository->create($data);

        return $result;

    }

    public function getProductsOrderBy($filterName)
    {
        return $this->productRepository->orderBy($filterName);
    }

    public function getProductById($id)
    {
        return $this->productRepository->find($id);
    }

    public function updateProduct($data,$id)
    {
        $product = $this->productRepository->find($id);

        $validate = Validator::make($data, [
            'name' => 'required',
            'description' => 'required',
            'categorie_id' => 'required',
            'price' => 'required',
            'image' => 'required'
        ]);        

        if($validate->fails()) {
            throw new InvalidArgumentException($validate->errors()->first());
        }

        $this->productRepository->update($data, $product);

    }

    public function deleteProduct($id)
    {
        $product = $this->productRepository->find($id);
        
        $this->productRepository->delete($product);
    }
    
}
