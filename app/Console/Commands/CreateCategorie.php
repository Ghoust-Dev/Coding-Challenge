<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Categorie;

class CreateCategorie extends Command
{
    protected $signature = 'create:categorie {name} {parent_categorie_id?}';


    protected $description = 'Create new Categorie';

   /*  public function __construct()
    {
        parent::__construct();
    } */

    public function handle()
    {
        $categorie = Categorie::create([
            'name' => $this->argument('name'),
            'parent_cat_id' => $this->argument('parent_categorie_id') ?? null,
        ]);

        $this->info('The Categorie '.$categorie->name.' has been created');
    }
}
