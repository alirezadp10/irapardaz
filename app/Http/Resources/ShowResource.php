<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'capacity'   => $this->capacity,
            'times'      => TimeTableResource::collection($this->times),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
