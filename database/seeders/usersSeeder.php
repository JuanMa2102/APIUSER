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
        $user->email="heri@gmail.com";
        $user->password="qwerty";

        $user->save();

        $user1= new User(); 

        $user1->name="Amber";
        $user1->email="amber@gmail.com";
        $user1->password="qwerty";

        $user1->save();
    }
}
