<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    
    public function store(Request $request)
    {
        
        $data = $request->only([
            'categorie'
        ]);
            
        $result = ['status' => 200];

        try {
            $result['data'] = $this->categoryService->save($data);
            $result['success'] = 'The Category has been added';
        }catch(Exception $e){
            $result = [
                'status'=> 500,
                'error'=>$e->getMessage(),
                'msgError' => 'The Category field is required.'
            ] ;
        }

        return response()->json($result,$result['status']);

    }

    public function show()
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->categoryService->showCategories();
        }catch(Exception $e){
            $result = [
                'status'=> 500,
                'error'=>$e->getMessage(),
            ] ;
        }

        return response()->json($result,$result['status']);

    }

    public function addSubCategorie(Request $request){

        $data = $request->only([
            'sub_categorie',
            'cat_parent_id'
        ]);
        
        $result = ['status' => 200];

        try {
            $result['data'] = $this->categoryService->saveSubCategorie($data);
            $result['success'] = 'The Sub-Category has been added';
        }catch(Exception $e){
            $result = [
                'status'=> 500,
                'error'=>$e->getMessage(),
                'msgError' => 'The Sub-Category field is required.'
            ] ;
        }

        return response()->json($result,$result['status']);
    }

    public function showCategorie($id){

        $result = ['status' => 200];

        try {
            $result['data'] = $this->categoryService->getCategorie($id);
        }catch(Exception $e){
            $result = [
                'status'=> 500,
                'error'=>$e->getMessage(),
            ] ;
        }

        return response()->json($result,$result['status']);
        
    }

    public function showSubCategorie($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->categoryService->getSubCategorie($id);
        }catch(Exception $e){
            $result = [
                'status'=> 500,
                'error'=>$e->getMessage(),
            ] ;
        }

        return response()->json($result,$result['status']);
    }


}
