<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userreq extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
}
