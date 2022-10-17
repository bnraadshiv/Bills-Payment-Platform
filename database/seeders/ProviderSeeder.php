<?php

namespace Database\Seeders;

use App\Models\Provider;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Provider::factory()->create([
            'name' => "Cap"

        ]);

        Provider::factory()->create([

            'name' => "PHED Direct"
        ]);

        Provider::factory()->create([

            'name' => "AEDC Direct"
        ]);
    }
}
