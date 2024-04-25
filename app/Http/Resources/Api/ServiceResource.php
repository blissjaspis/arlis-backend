<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class ServiceResource extends JsonResource
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
            'name' => $this->name,
            'price' => 'Rp '. Number::format($this->price, locale: 'id'),
            'price_raw' => $this->price,
            'type' => ucfirst($this->type),
            'duration_months' => $this->duration_months . ' '. Str::of('month')->plural($this->duration_months),
            'duration_months_raw' => $this->duration_months,
        ];
    }
}
