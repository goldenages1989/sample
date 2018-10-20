<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    //
    protected $table = 't_lines';

    protected $connection = 'subway';

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }
}
