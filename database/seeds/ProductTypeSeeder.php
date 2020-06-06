<?php

use App\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new ProductType();
        $model->name = "type 1";
        $model->save();

        $model = new ProductType();
        $model->name = "type 1";
        $model->save();
    }
}
