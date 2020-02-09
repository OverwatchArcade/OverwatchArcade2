<?php

namespace Tests\Unit;

use App\Models\Game\Daily;
use Carbon\Carbon;
use Tests\TestCase;

class GamemodeTest extends TestCase
{
    /* @var $daily \App\Models\Game\Daily */
    public $daily;

    protected function setUp(): void
    {
        $this->daily = new Daily(["tile_2" => 2, "user_battlenet_id" => "123"]);
        parent::setUp();
    }

    public function testHasNoTodaySet()
    {
        $daily = \Mockery::mock(Daily::class)->shouldReceive('hasGamemodesSetToday')->with();
        self::assertFalse($this->daily->hasGamemodesSetToday(Daily::GAME_KEY_OVERWATCH));
    }

    public function testHasTodaySet()
    {
        $daily = new Daily();
    }

}
