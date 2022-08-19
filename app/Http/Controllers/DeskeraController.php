<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DeskeraController extends Controller
{
    
    public function generateToken()
    {
        $clientid = env('DESKERA_CLIENT_ID');
        $secret= env('DESKERA_SECRET');
        $api_url= env('DESKERA_APP');

        $response = Http::get($api_url.'/comapny/token?clientid='.$clientid.'&clientsecret='.$secret);
        dd($response);
        return $response;
    }

    public function index() {
        
    }
}
