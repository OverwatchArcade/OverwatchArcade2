<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

/**
 *  Migration from the old site to keep the user contribution count
 */
class OldSiteMigration extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dailies')->truncate();
        $this->call(DailyTableSeeder::class);

        $oldSiteDailies = json_decode(File::get('database/data/old_site/todays.json'), true);
        $oldSiteUsers = json_decode(File::get('database/data/old_site/users.json'), true);

        foreach ($oldSiteDailies as $oldDaily) {
            $oldDaily['user_battlenet_id'] = $oldDaily['created_by'];
            $oldDaily['game'] = \App\Models\Game\Daily::GAME_KEY_OVERWATCH;
            unset($oldDaily['created_by']);
            unset($oldDaily['id']);

            $daily = \App\Models\Game\Daily::create($oldDaily);
            $daily->save();
        }

        foreach($oldSiteUsers as $oldUser){
            if(\App\Models\User::where('battlenet_id', $oldUser['id'])->first()){
                continue;
            }
            $user = new \App\Models\User();
            $user->battlenet_id = $oldUser['id'];
            $user->name = $oldUser['battletag'];
            $user->created_at = $oldUser['created_at'];
            $user->updated_at = $oldUser['updated_at'];
            $user->profile_data = [];
            $user->save();
        }
    }
}
