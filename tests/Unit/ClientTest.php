<?php

namespace Tests\Unit;

use App\Clients;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{
    /**
     * A basic unit test to check Client functionality.
     *
     * @return void
     */
    public function testClient()
    {
        $clientData = [
            'name' => 'test_client'
        ];

        factory(Clients::class)->create($clientData);

        $this->assertDatabaseHas('clients', $clientData);

        $client = Clients::where('name', 'test_client')->first();

        $client->delete();

        $this->assertSoftDeleted('clients', [
            'name' => 'test_client',
        ]);

    }
}
