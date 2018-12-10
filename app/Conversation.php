<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['user_id', 'contact_id', 'last_message', 'last_time'];
    protected $appends = ['contact_name', 'contact_image'];

    public function contact()
    {
        return $this->belongsTo('App\User', 'contact_id');
    }

    public function getContactNameAttribute()
    {
        // return $this->contact->name;
        return $this->contact()->first(['name'])->name;
    }

    public function getContactImageAttribute()
    {
        return '/users/' . $this->contact()->first(['image'])->image;
    }
}
