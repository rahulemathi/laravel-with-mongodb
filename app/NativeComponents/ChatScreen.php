<?php

namespace App\NativeComponents;

use App\Models\Message;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;

class ChatScreen extends NativeComponent
{

   public User $user;

    public string $message = '';

    public $messages = [];

       public function mount(): void
{
    $userId = $this->param('user');

    $this->user = User::findOrFail($userId);

    $this->loadMessages();
}

        public function loadMessages(): void
    {
        $currentUserId = Auth::id();
        $otherUserId = $this->user->id;

        $this->messages = Message::query()
            ->where(function ($query) use ($currentUserId, $otherUserId) {
                $query->where('sender_id', $currentUserId)
                    ->where('receiver_id', $otherUserId);
            })
            ->orWhere(function ($query) use ($currentUserId, $otherUserId) {
                $query->where('sender_id', $otherUserId)
                    ->where('receiver_id', $currentUserId);
            })
            ->orderBy('created_at')
            ->get();
    }

      public function sendMessage(): void
    {
        $this->message = trim($this->message);

        if ($this->message === '') {
            return;
        }

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $this->user->id,
            'message' => $this->message,
        ]);

        $this->message = '';

        $this->loadMessages();
    }

    public function render(): View
    {
        return view('native.chat-screen');
    }
}
