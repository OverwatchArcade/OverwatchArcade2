<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'battlenet_id' => 1,
            'name' => 'System',
            'profile_data' => [],
        ]);
    }
}
