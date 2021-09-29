<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        $user= new User(); 

        $user->name="Heriberto";
        $user->lastname="Guzman";
        $user->phone="9191780006";
        $user->direction="Calle Serdan";
        $user->cp="29950";
        $user->email="heri@gmail.com";
        $user->password="qwerty";
        $user->profile="1";

        $user->save();

        $user1= new User(); 

        $user1->name="Amber";
        $user1->lastname="Meneses";
        $user1->phone="9191788888";
        $user1->direction="Calle chilon";
        $user1->cp="29950";
        $user1->email="amber@gmail.com";
        $user1->password="qwerty";
        $user1->profile="1";

        $user1->save();

        
    }
}
