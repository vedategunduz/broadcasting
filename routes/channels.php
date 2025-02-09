<?php

use App\Models\MessageChannelUser;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('message-channel.{channelId}', function ($user, $channelId) {
    return MessageChannelUser::where('message_channel_id', $channelId)
        ->where('user_id', $user->id)
        ->exists();
});
