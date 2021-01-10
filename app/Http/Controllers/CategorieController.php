<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'categorie' => 'required'
        ]);

        if($validate->fails()){
            return response()->json(['status'=>false,'error'=>$validate->errors()]);
        }

        Categorie::create([
            'name' => $request->categorie
        ]);

        return response()->json(['status'=>true,'message'=>'Categorie has been added']);
    }

    public function show(Categorie $categorie)
    {
        $categories = Categorie::all()->whereNull('parent_cat_id');

        return response()->json(['status'=>true,'categories'=>$categories]);
    }

    public function addSubCategorie(Request $request){

        $validate = Validator::make($request->all(),[
            'sub_categorie' => 'required',
            'cat_parent_id' => 'required'
        ]);

        if($validate->fails()){
            return response()->json(['status'=>false,'error'=>$validate->errors()]);
        }

        Categorie::create([
            'name' => $request->sub_categorie,
            'parent_cat_id' => $request->cat_parent_id
        ]);

        return response()->json(['status'=>true,'message'=>'Sub-categorie has been added']);
    }

    public function showSubCategories($id)
    {
        $categories = Categorie::all()->where('parent_cat_id',$id);
        
        return response()->json(['status'=>true,'subCategories'=>$categories]);
    }

    public function showCategorie($id){
        $categorie = Categorie::find($id);
        
        return response()->json(['status'=>true,'categorie'=>$categorie]);
    }

}
