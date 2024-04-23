<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderByDesc('created_at')->get();

        return $this->responseJson(ServiceResource::collection($services));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required',
            'type' => 'required|string',
            'duration_months' => 'required',
        ]);

        Service::create([
            'name' => $request->name,
            'price' => $request->price,
            'type' => $request->type,
            'duration_months' => $request->duration_months
        ]);

        return $this->responseJson([
            'message' => 'Successfully create service'
        ]);
    }

    public function show(Service $service)
    {
        return $this->responseJson(new ServiceResource($service));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required',
            'type' => 'required|string',
            'duration_months' => 'required',
        ]);

        $service->update([
            'name' => $request->name,
            'price' => $request->price,
            'type' => $request->type,
            'duration_months' => $request->duration_months
        ]);

        return $this->responseJson([
            'message' => 'Successfully update service'
        ]);
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return $this->responseJson([
            'message' => 'Successfully delete service'
        ]);
    }
}
