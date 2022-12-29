<?php

namespace App\Console\Commands;

use App\Models\ClientPayment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ClientPaymentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment_command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pending Payment';

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
     * @return int
     */
    public function handle()
    {
        $clientPayments = ClientPayment::where('payment_status', 'completed')->where('next_payment_date', Carbon::today()->format('Y-m-d'))->get();
        if(count($clientPayments)) {
             $next_payment_date =Carbon::now()->addDays(30)->format('Y-m-d');
           foreach($clientPayments as $clientPayment) {
                ClientPayment::create([
                    'client_id' => $clientPayment->client_id,
                    'payment_status' => 'pending',
                    'payment_date' => Carbon::today()->format('d-m-Y'),
                    'next_payment_date' => $next_payment_date,
                ]);
           }
        }
        $this->info('The payment command is completed');
    }
}
