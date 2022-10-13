<?php

namespace Database\Seeders;

use api;
use App\Models\Product_api;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Product_apiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Product_api::factory()->create([

            'providerName' => 'PHED Direct',

        ]);
    }
}
