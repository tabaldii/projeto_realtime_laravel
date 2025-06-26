<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('notifications', function ($user) {
    return $user != null;
});

Broadcast::channel('chat', function ($user) {
    if ($user != null) {
        return ['id' => $user->id, 'name' => $user->name];
    }
});

Broadcast::channel('chat.greet.{receiver}', function ($user, $receiver) {
    return (int) $user->id === (int) $receiver;
});