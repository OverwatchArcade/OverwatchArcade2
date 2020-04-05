<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

/**
 *  Migration from the old site to keep the user contribution count
 */
class MigrateDailies extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dailies = json_decode(File::get('database/data/old_site/todays_202004051021.json'), true);
        foreach ($dailies['todays'] as $daily) {
            $daily['user_battlenet_id'] = $daily['created_by'];
            $daily['game'] = \App\Models\Game\Daily::GAME_KEY_OVERWATCH;
            unset($daily['created_by']);
            unset($daily['id']);

            $newDaily = \App\Models\Game\Daily::create($daily);
            $newDaily->save();
        }
    }
}
