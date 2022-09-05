<?php

/**
 * ==========================
 * Development By InnoScript
 * ==========================
 * Author       InnoScript Team
 * Email        dev@innoscript.co
 * Phone        09421038123
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeskeraModel;
use App\Models\Customer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;
use Exception;

class CustomerController extends Controller
{
    protected $deskera;
    protected $path;
    protected $pageSize;

    public function __construct(DeskeraModel $deskera) {
        dd($deskera);
        $this->deskera = $deskera;
        $this->path = 'master/customer';
        $this->pageSize = 100;
    }

    public function index () {
        $request = json_encode([
            'cdomain' => $this->deskera->cdomain
        ]);

        $url = "{$this->deskera->account_url}/{$this->path}?request=${request}&token={$this->deskera->token}";

        try {
            $response = Http::retry($this->deskera->retry, $this->deskera->timeout)->get($url);

            if($response->status() === 200) {
                $data = json_decode($response->body(), true);
                return response()->json($data,200);
            }

        } catch(Exception $e) {
            Log::channel('deskera')->info($e);
            return false;
        }
    }

    public function getDataFromOnTheGo() {
        $data = Customer::all()->toArray();
        return response()->json([
            'data' => $data
        ], 200);
    }

/**
 * Save Customer API [Deskera]
 *
 */
    public function save() {
        $data = [];

        $request = json_encode([
            "cdomain" => $this->deskera->cdomain,
            "username"=> $data["username"],
            "customernamevalue"=> $data["customernamevalue"],
            "userfullname"=> $data["userfullname"],
            "customercodevalue"=> $data["customercodevalue"],
            "accountcode"=> $data["accountcode"],
            "termvalue"=> $data["termvalue"],
            "creationDate"=> $data["creationDate"],
            "currencycode"=> $data["currencycode"],
            "sequenceformat"=>$data["sequenceformat"],
            "isVendor"=> $data["isVendor"],
            "customeraccountvalue"=> $data["customeraccountvalue"],
            "customfield" => $data["customfield"],
            "addressDetail" => $data["addressDetail"]
        ]);

        $url = "{$this->deskera->account_url}/{$this->path}?request=${request}&token={$this->deskera->token}";

        try {
            $response = Http::retry($this->deskera->retry, $this->deskera->timeout)->post($url);

            if($response->status() === 200) {
                $data = json_decode($response->body(), true);
                return response()->json($data,200);
            }

        } catch(Exception $e) {
            Log::channel('deskera')->info($e);
            return false;
        }
    }
}
