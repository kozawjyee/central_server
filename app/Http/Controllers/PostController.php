<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function index(){
        $token = self::generateToken();
        $cdomain = 'shwetechinternal';
        $response = Http::timeout(10)->get('http://sg36.accounting.deskera.com/rest/v1/master/product?request={cdomain:'.$cdomain.'}&token='.$token);
        
        if($response->status() === 401){
            $token = self::generateToken();
            $response = Http::timeout(10)->get('http://sg36.accounting.deskera.com/rest/v1/master/product?request={cdomain:'.$cdomain.'}&token='.$token);
        }

        $obj = json_decode($response, TRUE);
        $names = array();

        for($i=0; $i<count($obj['data']['typedata']); $i++){
            array_push($names,$obj['data']['typedata'][$i]['name']);
        }
        
        return $names;
    }

    public function generateToken()
    {
        $generateToken = Http::get('https://sg36.apps.deskera.com/rest/v1/company/token?clientid=XtCtmgWEiaTrJzhcAMsjWecTpEjR9VX2Jd9uBKP_f1A&clientsecret=CmufQMtVX6R83sRx2413Bo71OLya25CD6V07QdtpWIM');
        $token = $generateToken['token'];
        return $token;
    }
}
