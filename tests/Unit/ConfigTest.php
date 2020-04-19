<?php

namespace Tests\Unit;

use App\Models\Config;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class ConfigTest extends MockeryTestCase
{
    public $config;

    protected function setUp(): void
    {
        $this->config = new Config(["key" => Config::KEY_LABEL_OVERWATCH, "value" => ["tile_2" => "permanent"]]);
        parent::setUp();
    }

    public function testInvalidTileLabel()
    {
        self::assertNull($this->config->getTileLabel('tile_unknown'));
    }

    public function testDailyTileLabel()
    {
        self::assertEquals($this->config->getTileLabel('tile_2'), 'permanent');
    }
}
