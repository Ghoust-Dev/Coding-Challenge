<?php

namespace App\Repositories;

use App\Categorie;

class CategoryRepository
{
    
    public function create($request)
    {
        Categorie::create([
            'name' => $request['categorie']
        ]);
    }

    public function all()
    {
        return Categorie::all()->whereNull('parent_cat_id');
    }
    
    public function createSub($request)
    {
        Categorie::create([
            'name' => $request['sub_categorie'],
            'parent_cat_id' => $request['cat_parent_id']
        ]);
    }

    public function showSub($id)
    {
        return Categorie::where('parent_cat_id',$id)->get();
    }

    public function find($id)
    {
        return Categorie::find($id);
    }

    

}
