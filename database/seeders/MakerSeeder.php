<?php

namespace Database\Seeders;

use App\Models\Maker;
use Illuminate\Database\Seeder;

class MakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Maker::factory()->count(5)->create();
    }
}
