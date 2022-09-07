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
            Log::channel('deskera')->info($e);
            return false;
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
            'username' => $data['username'],
            'producttypevalue' => $data['producttypevalue'],
            'productname' => $data['productname'],
            'sequenceformatvalue' => $data['sequenceformatvalue'],
            'productID' => $data['productID'],
            'currencyvalue' => $data['currencyvalue'],
            'asOfDate' => $data['asOfDate'],
            'purchaseAccountValue' => $data['purchaseAccountValue'],
            'purchaseReturnAccountValue' => $data['purchaseReturnAccountValue'],
            'purchaseuom' => $data['purchaseuom'],
            'salesAccountValue' => $data['salesAccountValue'],
            'salesReturnAccountValue' => $data['salesReturnAccountValue'],
            'salesuom' => $data['salesuom'],
            'stockuom' => $data['stockuom'],
            'uom' => $data['uom'],
            'warehouseValue' => $data['warehouseValue'],
            'locationValue' => $data['locationValue'],
            'stockAdjustmentAccountValue' => $data['stockAdjustmentAccountValue'],
            'inventoryAccountValue' => $data['inventoryAccountValue'],
            'costOfGoodsSoldAccountValue' => $data['costOfGoodsSoldAccountValue'],
            'isWarehouseForProduct' => $data['isWarehouseForProduct'],
            'isLocationForProduct' => $data['isLocationForProduct'],
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
            Log::channel('deskera')->info($e);
            return false;
        }
    }
}
