<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //shortcut untuk define column massasignable

    protected $guarded;

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

}
