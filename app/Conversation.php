<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $appends = ['contact_name'];

    public function contact()
    {
        return $this->belongsTo('App\User', 'contact_id');
    }

    public function getContactNameAttribute()
    {
        // return $this->contact->name;
        return $this->contact()->first(['name'])->name;
    }
}
