<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OrderResource;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'service'])->orderByDesc('created_at')->get();

        return $this->responseJson(OrderResource::collection($orders));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_code' => 'required|string',
            'user_id' => 'required',
            'service_id' => 'required',
        ]);

        $service = Service::findOrFail($request->service_id);

        Order::create([
            'order_code' => $request->order_code,
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
            'total_price' => $service->price
        ]);

        return $this->responseJson([
            'message' => 'Successfully create order'
        ]);
    }

    public function show(Order $order)
    {
        return $this->responseJson(new OrderResource($order));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'order_code' => 'required|string',
            'user_id' => 'required',
            'service_id' => 'required',
        ]);

        $service = Service::findOrFail($request->service_id);

        $order->update([
            'order_code' => $request->order_code,
            'user_id' => $request->user_id,
            'service_id' => $service->id,
        ]);

        return $this->responseJson([
            'message' => 'Successfully update order'
        ]);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return $this->responseJson([
            'message' => 'Successfully delete order'
        ]);
    }
}
