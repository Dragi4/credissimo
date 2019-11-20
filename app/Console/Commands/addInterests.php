<?php

namespace App\Console\Commands;

use App\Deposits;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class addInterests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'interests:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run this command to add interests to all deposits and generate a report';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $today = Date::today()->format("Y-m-d");
        $fileName = 'reports/' . $today . '.txt';

        if (Storage::exists($fileName)) {
            $this->info('Report is already generated for today' . "\n");
            exit();
        }

        $client = new Client();

        $res = $client->get('http://data.fixer.io/api/latest?access_key=0d52da9f2090212bec148d7cd9d858b1');

        if ($res->getStatusCode() != '200') {
            $this->info('Cannot get currency rates for today' . "\n");
            exit();
        }


        DB::beginTransaction();

        try {
            $deposits = Deposits::all();
            $depositsSum = $deposits->sum('deposit');

            foreach ($deposits as $deposit) {
                $deposit->deposit *= 1.01;
                $deposit->save();
            }

            $dailyInterest = $depositsSum * 0.01;
            $currentDepositsSum = $depositsSum * 0.01;

            $rates = json_decode($res->getBody()->getContents());

            $BGNToUSD = $rates->rates->USD / $rates->rates->BGN;

            $dailyInterestUSD = $dailyInterest * $BGNToUSD;
            $currentDepositsSumUSD = $currentDepositsSum * $BGNToUSD;

            Storage::put($fileName, json_encode([
                'Daily interests'               => $dailyInterest,
                'Daily interests in USD'        => $dailyInterestUSD,
                'Current deposits sum'          => $currentDepositsSum,
                'Current deposits sum in USD'   => $currentDepositsSumUSD,
                'Date'                          => $today
            ]));

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->info('Error occured' . "\n");
        }
    }
}
