<?php

namespace Database\Seeders;

use App\Data\Models\Category;
use App\Data\Models\House;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        House::factory()
            ->count(2)
            ->create();
    }
}
