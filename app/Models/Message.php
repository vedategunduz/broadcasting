<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['sender_id', 'channel_id', 'content', 'status'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function channel()
    {
        return $this->belongsTo(MessageChannel::class, 'channel_id');
    }

    public function reads()
    {
        return $this->hasMany(MessageRead::class, 'message_id');
    }
}
