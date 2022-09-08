<?php

namespace App\Http\Controllers;

use App\Models\DeskeraModel;
use App\Models\Item;
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
        $this->path = 'master/product';
        $this->pageSize = 100;
    }

    public function getProductList()
    {
        $request = json_encode([
            'cdomain' => $this->deskera->cdomain
        ]);
        $url = "{$this->deskera->account_url}/{$this->path}?request={$request}&token={$this->deskera->token}";

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

    public function getDataFromOnTheGo()
    {
        $data = Item::all()->toArray();
        return response()->json([
            'data' => $data
        ], 200);
    }

    /**
     * Save Customer API [Deskera]
     *
     */

    public function postProductList()
    {
        $data = [];

        $request = json_encode([
            'cdomain' => $this->deskera->cdomain,
            'username' => $data['admin'],
            'producttypevalue' => $data['Inventory Part'],
            'productname' => $data['Wallet 4'],
            'sequenceformatvalue' => $data['NA'],
            'productID' => $data['Wallet04'],
            'currencyvalue' => $data['SGD'],
            'asOfDate' => $data['May 21, 2019 12:00:00 AM'],
            'purchaseAccountValue' => $data['Purchases'],
            'purchaseReturnAccountValue' => $data['Purchases'],
            'purchaseuom' => $data['Pcs'],
            'salesAccountValue' => $data['Sales'],
            'salesReturnAccountValue' => $data['Sales'],
            'salesuom' => $data['Pcs'],
            'stockuom' => $data['Pcs'],
            'uom' => $data['Pcs'],
            'warehouseValue' => $data['COMMERZONE'],
            'locationValue' => $data['Pune'],
            'stockAdjustmentAccountValue' => $data['Advertising'],
            'inventoryAccountValue' => $data['Advertising'],
            'costOfGoodsSoldAccountValue' => $data['Advertising'],
            'isWarehouseForProduct' => $data['true'],
            'isLocationForProduct' => $data['true'],
            'desc' => $data['desc'],
            'additionalDescription' => $data['additionalDescription'],
        ]);

        $url = "{$this->deskera->account_url}/{$this->path}?request={$request}&token={$this->deskera->token}";

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
}
