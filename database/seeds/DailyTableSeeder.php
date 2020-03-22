<?php

use Illuminate\Database\Seeder;

class DailyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Game\Daily::create([
            'game' => \App\Models\Game\Daily::GAME_KEY_OVERWATCH,
            'user_battlenet_id' => 1,
            'created_at' => \Carbon\Carbon::createFromDate('2020', '1', '1')
        ]);
        \App\Models\Game\Daily::create([
            'game' => \App\Models\Game\Daily::GAME_KEY_OVERWATCH2,
            'user_battlenet_id' => 1,
            'created_at' => \Carbon\Carbon::createFromDate('2020', '1', '1')
        ]);
    }
}
