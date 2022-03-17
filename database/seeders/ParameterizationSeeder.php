<?php

namespace Database\Seeders;

use App\Models\Parameterization;
use Illuminate\Database\Seeder;

class ParameterizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parameterization::factory()->count(5)->create();
    }
}
