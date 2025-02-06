<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageChannel extends Model
{
    protected $fillable = ['name', 'image', 'type'];

    public function messages()
    {
        return $this->hasMany(Message::class, 'channel_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'message_channel_users', 'message_channel_id', 'user_id');
    }
}
