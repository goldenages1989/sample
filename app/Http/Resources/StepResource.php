<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class StepResource extends Resource
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
            'name' => $this->name,
            'uid' => $this->uid,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'is_practical' => $this->is_practical,
            'line_id' => $this->line_id,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
