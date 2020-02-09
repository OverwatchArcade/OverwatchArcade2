<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class oAuthFeatureTest extends TestCase
{
    /**
     * Test if socialiate redirects
     *
     * @return void
     */
    public function testOAuthRedirect()
    {
        $response = $this->get('/login');
        $response->assertStatus(302);
    }


}
