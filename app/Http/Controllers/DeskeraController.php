<?php

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
        $data = $this->deskera->generateToken();
        return response()->json([
            "data" => $data
        ], 200);
    }
}
