<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $appends = ['from_me'];
    protected $fillable = ['from_id', 'to_id', 'content'];

    function getFromMeAttribute() {
        return $this->from_id == auth()->user()->id;
    }

}
