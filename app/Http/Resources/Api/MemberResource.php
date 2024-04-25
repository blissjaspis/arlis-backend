<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
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
            'user_name' => $this->user->name,
            'user_id' => $this->user->id,
            'service_name' => $this->service->name,
            'service_id' => $this->service->id,
            'expired_at' => $this->expired_at->format('Y-m-d'),
            'expired_at_result' => $this->expired_at->format('d M Y H:i'),
        ];
    }
}
