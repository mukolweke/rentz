<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Data\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DemoUsers
        User::create([
            'first_name' => 'demo',
            'last_name' => 'user',
            'email' => 'demouser@rentz.com',
            'password' => 'password1234'
        ]);

        $this->call([
            CategorySeeder::class,
            HouseSeeder::class,
            UnitSeeder::class,
        ]);
    }
}
