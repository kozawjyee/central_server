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
        $schedule->call(function(DeskeraModel $deskera) {
            try{
                DB::table('central_items')->insert([
                    'cdomain' => $deskera->cdomain,
                    'username' => 'admin',
                    'producttypevalue' => 'Inventory Part',
                    'productname' => '6 Yogurt P Bot Pack',
                    'sequenceformatvalue' => '6 Yogurt P Bot Pack',
                    'productID' => '6 Yogurt',
                    'currencyvalue' => 'MMK',
                    'asOfDate' => '2022-8-12 12:00:00',
                    'purchaseAccountValue' => 'Purchases',
                    'purchaseuom' => 'X6PBot',
                    'salesAccountValue' => 'Sales',
                    'salesReturnAccountValue' => 'Sales',
                    'salesuom' => 'X6PBot',
                    'stockuom' => 'X6PBot',
                    'uom' => 'X6PBot',
                    'warehouseValue' => 'YGN_WH',
                    'locationValue' => 'Yangon',
                    'stockAdjustmentAccountValue' => 'Inventory Adjustment Account',
                    'inventoryAccountValue' => 'inventory',
                    'costOfGoodsSoldAccountValue' => 'Cost of Good Sold',
                    'isWarehouseForProduct' => true,
                    'isLocationForProduct' => true,
                    'desc' => 'description',
                    'additionaldescription' => 'additional description',
                    'is_success' => true
                ]);
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
