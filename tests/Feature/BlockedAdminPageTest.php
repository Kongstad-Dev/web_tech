<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlockedAdminPageTest extends TestCase
{
    /** @test */
    public function testUnauthorizedMethodBlockedForAdminProductPage()
    {



        $response = $this->post('/productPageAdmin');


        $response->assertStatus(405);
    }
}
