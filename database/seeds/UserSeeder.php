<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new User();
        $model->nim = "2201754362";
        $model->name = "Andree Benaya Abyatar";
        $model->role = "admin";
        $model->email = "andree.abyatar@binus.edu";
        $model->password = bcrypt("asd123");
        $model->save();


        $model = new User();
        $model->nim = "2201231232";
        $model->name = "Anglie Yanto";
        $model->role = "student";
        $model->email = "anglie.yanto@binus.edu";
        $model->password = bcrypt("asd123");
        $model->save();


        
        $model = new User();
        $model->nim = "2209128309";
        $model->name = "Danny Wiselee";
        $model->role = "student";
        $model->email = "danny@binus.edu";
        $model->password = bcrypt("asd123");
        $model->save();
    }
}
