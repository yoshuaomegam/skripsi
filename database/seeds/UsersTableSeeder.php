<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
    //  //Membuat role member
    //  $operatorRole = new  Role();
    //  $operatorRole->name = "operator";
    //  $operatorRole->display_name = "operator";
    //  $operatorRole->save();

    //  $bappemasRole = new Role();
    //  $bappemasRole->name="bappemas";
    //  $bappemasRole->display_name="bappemas";
    //  $bappemasRole->save();
     


    //  $operator = new User();
    //  $operator->name = 'operator';
    //  $operator->email = 'operator@gma il.com';
    //  $operator->password = bcrypt('123456');
    //  $operator->save();
    //  $operator->attachRole('operator');

     $bappemas = new User();
     $bappemas->name = 'bappemas';
     $bappemas->email = 'bappemas@gmail.com';
     $bappemas->password = bcrypt('123456');
     $bappemas->save();
     $bappemas->attachRole('bappemas');
    }
}
