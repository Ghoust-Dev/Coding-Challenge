<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class CategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function save($request)
    {
        $validate = Validator::make($request,[
            'categorie' => 'required'
        ]);


        if($validate->fails()){            
            throw new InvalidArgumentException($validate->errors()->first());
        }
        
        $result = $this->categoryRepository->create($request);

        return $result;
    }

    public function showCategories()
    {
        $result = $this->categoryRepository->all();

        return $result;
    }

    public function saveSubCategorie($request)
    {
        $validate = Validator::make($request,[
            'sub_categorie' => 'required',
            'cat_parent_id' => 'required'
        ]);


        if($validate->fails()){            
            throw new InvalidArgumentException($validate->errors()->first());
        }
        
        $result = $this->categoryRepository->createSub($request);

        return $result;
    }

    public function getCategorie($id)
    {
        $categorie = $this->categoryRepository->find($id);

        return $categorie;
    }

    public function getSubCategorie($id)
    {
        $categorie = $this->categoryRepository->showSub($id);

        return $categorie;
    }

    
}
