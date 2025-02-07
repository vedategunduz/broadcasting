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

    #[On('echo-private:message-channel.{channel_id},MessageCreated')]
    public function mount($channelId)
    {
        $this->messages = Message::where('channel_id', 1)->latest()->take($this->messageCount)->get();
    }

    public function incrementMessageCount()
    {
        $this->messageCount += 5;

        $this->mount($this->channelId);
    }

    public function messageCreated($message)
    {
        $this->messages->prepend($message);
    }

    public function render()
    {
        return view('livewire.message-component');
    }
}
