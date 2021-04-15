<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    public $timestamps = true;
    public function userreqs()
    {
        return $this->hasMany(userreq::class)->orderBy('created_at', 'desc');
    }
}
