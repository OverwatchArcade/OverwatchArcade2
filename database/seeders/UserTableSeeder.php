<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
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
