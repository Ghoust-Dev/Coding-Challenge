<?php

namespace App\Console\Commands;

use App\Categorie;
use Illuminate\Console\Command;

class DeleteCategorie extends Command
{
    protected $signature = 'delete:categorie {id}';

    protected $description = 'Delete Categorie';

   /*  public function __construct()
    {
        parent::__construct();
    } */

    public function handle()
    {
        $categorie = Categorie::find($this->argument('id'));
        $categorie->delete();
        
        $this->warn('The Categorie '.$categorie->name.' has been deleted');
    }
}
