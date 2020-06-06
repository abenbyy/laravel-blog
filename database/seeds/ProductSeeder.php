<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $datas = [
            [
                'name' => 'asd',
                'price' => 10000
            ],
            [
                'name' => 'qwe',
                'price' => 50000
            ]
        ];
    
        foreach ($datas as $d){
            $model = new Product();
            $model->product_type_id = 1;
            $model->name = $d['name'];
            $model->price = $d['price'];
            $model->save();
        }

        for($i=0; $i<10 ; $i++){
            $model = new Product();
            $model->product_type_id = 1;
            $model->name = $faker->name;
            $model->price = $faker->numberBetween(1000, 100000);
            $model->save();
        }
    }
}
