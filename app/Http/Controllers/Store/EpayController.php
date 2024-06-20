<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EpayController extends Controller
{
    public function check(Request $request)
    {
        Log::info(print_r($request->all(), true));
        echo 'ok';
    }
    public function fail(Request $request)
    {
        Log::info(print_r($request->all(), true));
        echo 'ok';
    }
}
