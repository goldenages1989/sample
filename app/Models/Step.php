<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    //
    protected $table = 't_steps';

    protected $connection = 'subway';

    public function line()
    {
        return $this->belongsTo(Line::class);
    }
}
