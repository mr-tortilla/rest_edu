<?php

namespace App\Http\Repositories\Receipt;

use App\Jobs\ReceiptBackgroundJob;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class ReceiptRepository
{

    public function register()
    {

    }

    public function make(array $receipt_data)
    {
        $response = Http::get(env('RECEIPT_SERVER') . '/makeReceipt', $receipt_data);

        return $response->getBody()->getContents();
    }

    public function make_bg(array $receipt_data)
    {
        $job = new ReceiptBackgroundJob($receipt_data);
        dispatch($job)->onQueue('rabbitmq')->delay(5);
    }
}
