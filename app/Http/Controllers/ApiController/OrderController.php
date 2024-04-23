<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OrderResource;
use App\Models\Order;
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
            'name' => 'required|string',
            'user_id' => 'required',
            'service_id' => 'required',
            'total_price' => 'required',
        ]);

        Order::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
            'total_price' => $request->total_price
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
            'name' => 'required|string',
            'user_id' => 'required',
            'service_id' => 'required',
            'total_price' => 'required',
        ]);

        $order->update([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
            'total_price' => $request->total_price
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
