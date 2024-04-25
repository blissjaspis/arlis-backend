<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Number;

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
            'id' => $this->id,
            'order_code' => $this->order_code,
            'user_name' => $this->user->name,
            'user_id' => $this->user->id,
            'service_id' => $this->service->id,
            'service_name' => $this->service->name,
            'total_price' => 'Rp ' . Number::format($this->total_price, locale:'id')
        ];
    }
}
