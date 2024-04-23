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
            'user_name' => $this->id,
            'user_name' => $this->user->name,
            'service_name' => $this->service->name,
            'expired_at' => $this->expired_at->format('d M Y H:i')
        ];
    }
}
