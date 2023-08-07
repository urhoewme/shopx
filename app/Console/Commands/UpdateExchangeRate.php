<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateExchangeRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency exchange rate';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $result = [];
        $apiKey = env('EXCHANGE_API_KEY');
        $client = new Client();
        $response = $client->get("https://v6.exchangerate-api.com/v6/". $apiKey . "/latest/USD");
        $data = json_decode($response->getBody(), true);
        foreach ($data['conversion_rates'] as $name => $value) {
            $result[] = [
                'name' => $name,
                'rate' => $value
            ];
        }
        DB::table('exchange_rates')->insert($result);
    }
}
