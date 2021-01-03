<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class MessageResource
 * @package App\Http\Resources
 */
class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->sender_id == auth('api')->id() ? 'sender' : 'receiver',
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'message' => $this->message,
            'timestamp' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
        ];
    }
}
