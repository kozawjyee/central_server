<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeskeraModel;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    protected $deskera;
    protected $customerList;
    public function __construct(DeskeraModel $deskera){
        $this->deskera = $deskera;
    }

    public function fetchData($request)
    {
        $url = "{$this->deskera->account_url}/master/customer?request={$request}&token={$this->deskera->token}";
        try {
            $response = Http::retry($this->deskera->retry, $this->deskera->timeout)->get($url);
            $status = $response->status();

            if($response->status() === 200) {
                $data = json_decode($response->body(), true);
                return response()->json($data,200);
            }
        } catch(Exception $e) {
            return Log::info($e);
        }
    }

    public function getCustomerData(){
        $requestbody = json_encode([
            'cdomain' => $this->deskera->cdomain
        ]);
        $data = $this->fetchData($requestbody);
        foreach($data as $key=>$value){
            dd($data);
        }
        return ;
    }
}
