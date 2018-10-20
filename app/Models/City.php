<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $table = 't_citys';

    protected $connection = 'subway';

    public function lines()
    {
        return $this->hasMany(Line::class);
    }
}
