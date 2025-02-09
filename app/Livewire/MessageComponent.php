<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\MessageChannel;
use Livewire\Attributes\On;
use Livewire\Component;

class MessageComponent extends Component
{
    public $messages;
    public $messageCount = 5;
    public $channelId;

    public function mount($channelId)
    {
        $this->channelId = $channelId;

        $this->messages = Message::where('channel_id', $channelId)
            ->latest()
            ->take($this->messageCount)
            ->get()->toArray();

        // dd($this->messages);
    }

    public function incrementMessageCount()
    {
        $this->messageCount += 5;

        $this->mount($this->channelId);
    }

    #[On('echo-private:message-channel.{channelId},MessageCreated')]
    public function messageCreated($message)
    {
        $newMessage = $message['message'];

        array_push($this->messages, $newMessage);
        // $this->messages->prepend($newMessage);
    }


    public function render()
    {
        return view('livewire.message-component');
    }
}
