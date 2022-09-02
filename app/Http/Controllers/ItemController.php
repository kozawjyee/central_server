<?php

namespace App\Http\Controllers;

use App\Models\DeskeraModel;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    //
    protected $deskera;

    public function __construct(DeskeraModel $deskera)
    {
        $this->deskera = $deskera;
    }

    public function getProductList()
    {
        $request = json_encode([
            'cdomain' => $this->deskera->cdomain
        ]);
        $url = "{$this->deskera->account_url}/master/product?request={$request}&token={$this->deskera->token}";

        try {
            $response = Http::retry($this->deskera->retry, $this->deskera->timeout)->get($url);
            $status = $response->status();

            if ($response->status() === 200) {
                $data = json_decode($response->body(), true);

                return response()->json($data, 200);
            }
        } catch (Exception $e) {
            return Log::info($e);
        }
    }

    public function postProductList()
    {
        $request = json_encode([
            'cdomain' => $this->deskera->cdomain,
            'username' => 'admin',
            'producttypevalue' => 'Inventory Part',
            'productname' => 'Wallet 4',
            'sequenceformatvalue' => 'NA',
            'productID' => 'Wallet04',
            'currencyvalue' => 'SGD',
            'asOfDate' => 'May 21, 2019 12:00:00 AM',
            'purchaseAccountValue' => 'Purchases',
            'purchaseReturnAccountValue' => 'Purchases',
            'purchaseuom' => 'Pcs',
            'salesAccountValue' => 'Sales',
            'salesReturnAccountValue' => 'Sales',
            'salesuom' => 'Pcs',
            'stockuom' => 'Pcs',
            'uom' => 'Pcs',
            'warehouseValue' => 'COMMERZONE',
            'locationValue' => 'Pune',
            'stockAdjustmentAccountValue' => 'Advertising',
            'inventoryAccountValue' => 'Advertising',
            'costOfGoodsSoldAccountValue' => 'Advertising',
            'isWarehouseForProduct' => 'true',
            'isLocationForProduct' => 'true'
        ]);

        // dd($request);
        $url = "{$this->deskera->account_url}/master/product?request={$request}&token={$this->deskera->token}";
        // $response = Http::post($url);
        // return response()->json([
        //     'data' => $response,
        //     "success" => true
        // ],200);

        try {
            $response = Http::retry($this->deskera->retry, $this->deskera->timeout)->post($url);
            $status = $response->status();

            if ($response->status() === 200) {
                $data = json_decode($response->body(), true);

                return response()->json($data, 200);
            }
        } catch (Exception $e) {
            return Log::info($e);
        }
    }

    public function getProductPrice()
    {
        $request = json_encode([
            'cdomain' => $this->deskera->cdomain,
            "isdefaultHeaderMap" => false,
            "customervalue" => "C5",
            "currencycode" => "SGD",
            "getSOPOflag" => "true",
            "products" => "Test1,AAA",
            "quantity" => "",
            "transactiondate" => "Mar 13, 2019 12:00:00 AM",
            "gcurrencyid" => "6",
            "timezonedifference" => "+8.00",
        ]);
        $url = "{$this->deskera->account_url}/transaction/productpriceV2?request={$request}&token={$this->deskera->token}";

        try {
            $response = Http::retry($this->deskera->retry, $this->deskera->timeout)->get($url);
            $status = $response->status();

            if ($response->status() === 200) {
                $data = json_decode($response->body(), true);

                return response()->json($data, 200);
            }
        } catch (Exception $e) {
            return Log::info($e);
        }
    }

    public function getAvailableStock()
    {
        $request = json_encode(([
            'cdomain' => $this->deskera->cdomain,
            "productvalue" => "PRO_001",
            "warehouse" => "DS,COMMERZONE",
            "locationname" => "Default Location"
        ]));
        $url = "{$this->deskera->account_url}/inventory/product-available-stock?request={$request}&token={$this->deskera->token}";

        try {
            $response = Http::retry($this->deskera->retry, $this->deskera->timeout)->get($url);
            $status = $response->status();

            if ($response->status() === 200) {
                $data = json_decode($response->body(), true);

                return response()->json($data, 200);
            }
        } catch (Exception $e) {
            return Log::info($e);
        }
    }
}
