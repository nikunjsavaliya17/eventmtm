<?php

namespace App\Http\Resources;

use App\Models\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'event_id' => $this->event_id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => getFileUrl($this->image, Event::IMG_DIR),
            'address' => $this->address,
            'event_date' => formatDate($this->start_date, 'd-m-Y'),
            'event_time' => formatDate($this->start_date, 'h:i:s'),
            'event_location' => [
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ],
        ];
    }
}
