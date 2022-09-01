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

use App\Models\DeskeraModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;

class DeskeraController extends Controller
{
    protected $deskera;

    public function __construct(DeskeraModel $deskera) {
        $this->deskera = $deskera;
    }

    public function index() {
        $data = $this->deskera->generateToken();
        return response()->json([
            "data" => $data
        ], 200);
    }
}
