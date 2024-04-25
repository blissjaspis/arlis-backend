<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpController extends Controller
{
    public function status()
    {
        $status = Auth::guard('user-api')->check();

        return $this->responseJson([
            'status' => $status,
            'message' => $status ? "You're authenticated" : "You're not authenticated"
        ]);
    }
}
