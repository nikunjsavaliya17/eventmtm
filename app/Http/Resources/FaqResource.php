<?php

namespace App\Http\Resources;

use App\Models\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'faq_id' => $this->faq_id,
            'question' => $this->question,
            'answer' => $this->answer,
        ];
    }
}
