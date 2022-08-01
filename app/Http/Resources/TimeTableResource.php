<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimeTableResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'day'  => $this->day,
            'time' => $this->time
        ];
    }
}
