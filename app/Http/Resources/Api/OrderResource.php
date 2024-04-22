<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_code' => $this->order_code,
            'user_name' => $this->user->name,
            'service_name' => $this->service->name,
            'total_order' => $this->total_price
        ];
    }
}
