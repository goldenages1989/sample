<?php

namespace App\Http\Controllers;

use App\Http\Resources\LineResource;
use App\Http\Resources\StepResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //
    public function index()
    {
//        $lines = City::find(1)->lines()->where('id',1)->first()->steps;
        //hasManyThrough
        $lines = City::find(1)->steps;
        return StepResource::collection($lines);
    }
}
