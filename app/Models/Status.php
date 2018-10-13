<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model 
{
        public function User()
        {
                return $this->belongsTo(User::class);
        }
}
