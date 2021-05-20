<?php

namespace App\Jobs;

use Abraham\TwitterOAuth\TwitterOAuth;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class OverwatchTwitterPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const SCREENSHOT_FILE = "overwatchScreenshot.jpg";

    public $gametype;
    public $url;

    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    private function getTwitterText()
    {
        return "Today's Overwatch arcade modes - " . Carbon::now()->format('D, d M') . " #overwatch #owarcade";
    }

    public function createScreenshot()
    {
        $params = http_build_query(array(
            "access_key" => config('screenshot.apiflash_key'),
            "url" => route('API_OW_SCREENSHOT'),
            "user_agent" => config('screenshot.apiflash_user_agent'),
            "ttl" => 0,
            "fresh" => true
        ));
        $file = file_get_contents("https://api.apiflash.com/v1/urltoimage?" . $params);
        Storage::disk('public')->put(self::SCREENSHOT_FILE, $file);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->createScreenshot();
        $twitter = new TwitterOAuth(config('twitter.consumer_key'), config('twitter.consumer_secret'),
            config('twitter.access_token'), config('twitter.secret_token'));
        $media = $twitter->upload('media/upload',
            ['media' => Storage::disk('public')->path(self::SCREENSHOT_FILE)]);
        $parameters = [
            'status' => $this->getTwitterText(),
            'media_ids' => implode(',', [$media->media_id_string])
        ];
        $result = $twitter->post('statuses/update', $parameters);
    }
}
