<?php

use Illuminate\Database\Seeder;
use App\Clients;
use App\Accounts;
use App\Deposits;

class ClientsSeeder extends Seeder
{
    /**
     * Seed clients and make two accounts for each client
     * Then create a initial deposit for each account
     * @return void
     */
    public function run()
    {
        factory(Clients::class, 2)->create()->each(function($client) {
            $client->accounts()
                ->saveMany( factory(Accounts::class, 2)->make() )
                ->each(function($account){
                    $account->deposits()->save(factory(Deposits::class)->make());
                });
        });
    }
}
