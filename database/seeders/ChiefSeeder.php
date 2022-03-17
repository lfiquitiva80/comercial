<?php

namespace Database\Seeders;

use App\Models\Chief;
use Illuminate\Database\Seeder;

class ChiefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chief::factory()->count(5)->create();
    }
}
