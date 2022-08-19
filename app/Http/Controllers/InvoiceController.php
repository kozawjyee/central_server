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
use Illuminate\Support\Facades\Http;

class InvoiceController extends Controller
{
    
    protected $deskera;

    public function __construct(DeskeraModel $deskera) {
        $this->deskera = $deskera;
    }

    public function getInvoice() {
        $request = json_encode([
            'cdomain' => $this->deskera->cdomain
        ]);
        $url = "{$this->deskera->account_url}/transaction/invoice?request=${request}&token={$this->deskera->token}";

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
}
