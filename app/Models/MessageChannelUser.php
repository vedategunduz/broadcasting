<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageChannelUser extends Model
{
    protected $fillable = ['message_channel_id', 'user_id'];
}
