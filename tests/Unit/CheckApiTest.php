<?php

namespace Tests\Unit;

use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckApiTest extends TestCase
{
    /**
     * A basic unit test to check response from url.
     *
     * @return void
     */
    public function testCheckApi()
    {
        $client = new Client();

        $response = $client->get('http://data.fixer.io/api/latest?access_key=0d52da9f2090212bec148d7cd9d858b1');

        $response->assertStatus(200);
    }
}
