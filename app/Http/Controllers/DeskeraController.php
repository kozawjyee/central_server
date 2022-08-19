<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;

class DeskeraController extends Controller
{
    protected $url;
    protected $retry;
    protected $timeout;

    public $token;

    public function __construct() {
        $this->url = env('DESKERA_TOKEN_URL');
        $this->retry = env('HTTP_RETRY');
        $this->timeout = env('HTTP_TIMEOUT');
    }

    public function generateToken() {

        // $responses = Http::pool(fn (Pool $pool) => [
        //     $pool->get('http://localhost/first'),
        //     $pool->get('http://localhost/second'),
        //     $pool->get('http://localhost/third'),
        // ]);

        try {
            $response = Http::retry($this->retry, $this->timeout)->get($this->url);
            $status = $response->status();
            
            if($response->status() === 200) {
                $data = json_decode($response->body(), true);
                $this->token = $data['token'];
            }

        } catch(Expection $e) {
            return Log::info($e);
        }
    }
}
