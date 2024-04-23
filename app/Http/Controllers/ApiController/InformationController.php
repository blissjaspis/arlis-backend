<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\InformationResource;
use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index()
    {
        $informations = Information::orderByDesc('created_at')->get();

        return $this->responseJson(InformationResource::collection($informations));
    }

    public function store(Request $request)
    {
        $request->validate([
            'food_recomendation' => 'required|string',
        ]);

        Information::create([
            'food_recomendation' => $request->food_recomendation,
        ]);

        return $this->responseJson([
            'message' => 'Successfully create information'
        ]);
    }

    public function show(Information $information)
    {
        return $this->responseJson(new InformationResource($information));
    }

    public function update(Request $request, Information $information)
    {
        $request->validate([
            'food_recomendation' => 'required|string',
        ]);

        $information->update([
            'food_recomendation' => $request->food_recomendation
        ]);

        return $this->responseJson([
            'message' => 'Successfully update information'
        ]);
    }

    public function destroy(Information $information)
    {
        $information->delete();

        return $this->responseJson([
            'message' => 'Successfully delete information'
        ]);
    }
}
