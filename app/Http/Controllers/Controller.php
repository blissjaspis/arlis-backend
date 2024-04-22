<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ResponseSequence;

abstract class Controller
{
    public function responseJson($data, $status =  200)
    {
        return response()->json($data, $status);
    }
}
