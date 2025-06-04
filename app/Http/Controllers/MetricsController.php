<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class MetricsController extends Controller
{
    public function index()
    {
        return response("METRICS OK", 200)->header('Content-Type', 'text/plain');
    }
}

