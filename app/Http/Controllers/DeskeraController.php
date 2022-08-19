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

class DeskeraController extends Controller
{
    protected $deskera;

    public function __construct(DeskeraModel $deskera) {
        $this->deskera = $deskera;
    }

    public function index() {
        return response()->json([
            'token' => $this->deskera->token
        ],200);
    }
}
