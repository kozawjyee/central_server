<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\CustomerController;
use App\Models\Customer;
use App\Models\DeskeraModel;
use Illuminate\Support\Facades\Http;
use App\Models\CentralItems;
use Illuminate\Support\Facades\DB;
use App\Models\DSK_item;
use App\Models\DSK_Customer;

use Exception;

class Kernel extends ConsoleKernel
{

    protected $current_page;
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\DeskeraCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('log:deskeraCron')->everyMinute();
        $schedule->call(function(DSK_Customer $dsk_customer){
            try{
                $dsk_customer->postCustomer();
            }catch(Exception $e){
                Log::channel('deskera')->info($e);
                return false;
            }
        })->everyMinute();
        $schedule->call(function(DeskeraModel $deskera, DSK_item $dsk_item) {
            try{
                    $dsk_item->storeData();
                }catch(Exception $e){
                    Log::channel('deskera')->info($e);
                    return false;
                }
        })->everyMinute();
        $schedule->call(function() {
            $customers = Customer::all()->toArray();

            foreach($customers as $customer) {
                $deskera = new DeskeraModel;
                Log::channel('deskera')->info($deskera->timeout);

                $request = [
                    "cdomain" => $deskera->cdomain,
                    "username"=> $customer["Name"],
                    "customernamevalue"=> $customer["Name"],
                    "userfullname"=> $customer["Name"],
                    "customercodevalue"=> $customer["CustomerID"],
                    // "accountcode"=> $data["accountcode"],
                    // "termvalue"=> $data["termvalue"],
                    // "creationDate"=> $data["creationDate"],
                    // "currencycode"=> $data["currencycode"],
                    // "sequenceformat"=>$data["sequenceformat"],
                    // "isVendor"=> $data["isVendor"],
                    // "customeraccountvalue"=> $data["customeraccountvalue"],
                    // "customfield" => $data["customfield"],
                    "salesPerson" => $customer["SalesPersonName"]
                ];



                $url = $deskera->account_url."/master/customer?request=".json_encode($request)."&token=".$deskera->token;

                try {
                    $response = Http::retry($deskera->retry, $deskera->timeout)->post($url);

                    if($response->status() === 200) {
                        Log::channel('deskera')->info($response->body());
                        // $data = json_decode($response->body(), true);
                        // return response()->json($data,200);
                    }

                } catch(Exception $e) {
                    Log::channel('deskera')->info($e);
                    return false;
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
