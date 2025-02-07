<?php

use App\Models\MessageChannelUser;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('message-channel.{channel_id}', function ($user, $channel_id) {
    return MessageChannelUser::where('message_channel_id', 1)
        ->where('user_id', $user->id)
        ->exists();
});
