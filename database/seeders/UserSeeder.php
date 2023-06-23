<?php

namespace Database\Seeders;

use App\Data\Constants;
use App\Data\Models\House;
use App\Data\Models\Unit;
use App\Data\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Seed Admin User
         */
        User::create([
            'name' => 'Demo Admin',
            'email' => 'demoadmin@rentz.com',
            'phone' => '(+254)720 000 000',
            'role' => 'admin',
            'password' => Constants::DEFAULT_PASSWORD,
        ]);

        /**
         * Seed Staff User
         */
        $staffUser = User::create([
            'name' => 'Demo Staff',
            'email' => 'demostaff@rentz.com',
            'role' => 'staff',
            'phone' => '(+254)720 000 001',
            'password' => Constants::DEFAULT_PASSWORD,
        ]);

        /// Assign staff to a house and give a role
        $staffUser->staff()->create(['house_id' => House::first()->id, 'role' => 'Caretaker']);

        /**
         * Seed Tenant User
         */
        $tenantUser = User::create([
            'name' => 'Demo Tenant',
            'email' => 'demotenant@rentz.com',
            'role' => 'tenant',
            'phone' => '(+254)720 000 002',
            'password' => Constants::DEFAULT_PASSWORD,
        ]);

        $unitId = Unit::first()->id;

        $tenantUser->tenant()->create(['unit_id' => $unitId, 'is_active' => true]);

        // Mark unit as assigned
        \DB::table('units')->where('id', $unitId)->update(['status' => true]);
    }
}
