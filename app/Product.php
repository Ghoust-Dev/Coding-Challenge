<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'categorie_id', 'sub_categorie_id', 'price', 'image'
    ];

    public function Categorie()
    {
        return $this->belongsTo('App\Categorie', 'categorie_id');
    }
}
