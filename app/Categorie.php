<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = [
        'name', 'parent_cat_id'
    ];

    protected $guarded = [];
}
