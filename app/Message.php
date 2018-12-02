<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Message extends Model
{
    protected $fillable = ['from_id', 'to_id', 'content'];
    // protected $appends = ['from_me'];

    // function getFromMeAttribute() {

    //     $user = Auth::user();
    //     if (!$user) {
    //         return false;
    //     }

    //     return $this->from_id == $user->id;
    // }

}
