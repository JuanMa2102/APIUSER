<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aplication;

class AplicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
        $aplication= new Aplication(); 

        $aplication->name="Heriberto";
        $aplication->description="Sin descripcion";
        $aplication->url="Sin descripcion";
      
        $aplication->save();

        $aplication1= new Aplication(); 

        $aplication1->name="Amberlain";
        $aplication1->description="Sin descripcion";
        $aplication1->url="Sin descripcion";
      
        $aplication1->save();
    }
}
