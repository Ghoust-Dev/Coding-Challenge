<?php

namespace App\Console\Commands;

use App\Product;
use Illuminate\Console\Command;

class DeleteProduct extends Command
{
    protected $signature = 'delete:product {id}';

    protected $description = 'Delete Product';

    public function handle()
    {
        $product = Product::find($this->argument('id'));
        $product->delete();
        
        $this->warn('The Product '.$product->name.' has been deleted');
    }
}
