<?php

namespace App\Jobs\Account;

use App\Mail\Account\WelcomeContract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WelcomeContractJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $customer;
    public $document;

    /**
     * Create a new job instance.
     *
     * @param $customer
     * @param $document
     */
    public function __construct($customer, $document)
    {
        //
        $this->customer = $customer;
        $this->document = $document;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Mail::to($this->customer)->send(new WelcomeContract($this->customer));
    }
}
