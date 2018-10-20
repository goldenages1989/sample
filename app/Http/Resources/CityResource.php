<?php

namespace App\Http\Resources;

use App\Models\City;
use Illuminate\Http\Resources\Json\Resource;

class CityResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * @var City $city
         */
        $city = $this;
        return [
            'id' => $city->id,
            'cn_name' => $city->cn_name,
            'en_name' => $city->en_name,
            'code' => $city->code,
            'pre' => $city->pre,
            'created_at'=> $city->created_at->toDateTimeString(),
            'updated_at' => $city->updated_at->toDateTimeString(),
        ];
    }
}
