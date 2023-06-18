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
        $categoryId = Category::where('slug', 'apartment')->first()->id;

        $houses = [
            [
                'name' => 'GKM Apartments',
                'category' => $categoryId,
            ],
            [
                'name' => 'Starlight Homes',
                'category' => $categoryId,
            ]
        ];

        foreach ($houses as $house) {
            House::create($house);
        }
    }
}
