<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * src: https://www.pacaso.com/blog/types-of-houses
         *
         * if possible in future we seed the images & description.
         */
        $houseTypes = [
            'Single-family detached',
            'Apartment',
            'Condominium',
            'Co-op',
            'Town Home',
            'Coach home',
            'Chalet',
            'Cabin',
            'Tiny house',
            'Mobile home',
            'Modular home',
        ];

        foreach ($houseTypes as $type) {
            \App\Data\Models\Category::create(['name' => $type]);
        }
    }
}
