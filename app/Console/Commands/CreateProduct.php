<?php

namespace App\Console\Commands;

use App\Product;
use Illuminate\Console\Command;

class CreateProduct extends Command
{
    protected $signature = 'create:product {name} {description} {price} {image} {categorie_id} {sub_categorie_id?}';

    protected $description = 'Create a new Product';

    /* public function __construct()
    {
        parent::__construct();
    } */

    public function handle()
    {
        $product = Product::create([
            'name' => $this->argument('name'),
            'description' => $this->argument('description'),
            'price' => $this->argument('price'),
            'image' => 'uploads/products/images/'.$this->argument('image'),
            'categorie_id' => $this->argument('categorie_id'),
            'sub_categorie_id' => $this->argument('sub_categorie_id') ?? null,
        ]);

        $this->info('The Product '.$product->name.' has been created');
    }
}
