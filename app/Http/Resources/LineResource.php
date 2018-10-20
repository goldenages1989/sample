<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class LineResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $line = $this;
        return [
            'id' => $line->id,
            'link' => 'wwww.baidu.com',
            'name' => $line->name,
            'uid' => $line->uid,
            'pair_uid' => $line->pair_uid,
            'city_id' =>$line->city_id,
            'created_at' => $line->created_at->toDateTimeString(),
            'updated_at' => $line->updated_at->toDateTimeString(),
        ];
    }
}
