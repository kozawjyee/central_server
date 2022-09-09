<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\DeskeraModel;
use App\Models\Item;

class DSK_item extends Model
{
    use HasFactory;

    protected $deskera;
    protected $path;
    protected $pageSize;

    public function __construct(DeskeraModel $deskera) {
        $this->deskera = $deskera;
    }


    public function storeData(){

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
    }
}
