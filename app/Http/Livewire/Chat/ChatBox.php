<?php

namespace App\Http\Livewire\Chat;

use App\Models\Message;
use Livewire\Component;
use App\Notifications\MessageRead;
use App\Notifications\MessageSent;
use Illuminate\Support\Facades\Auth;

class ChatBox extends Component
{
    public $selectedConversation;
    public $body;
    public $loadedMessages;

    public $paginate_var = 10;
    protected $listeners = ['loadMore'];

    public function getListeners()
    {
        $auth_id = auth()->user()->id;

        return [
            'loadMore',
            "echo-private:users.{$auth_id},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated" => 'broadcastedNotifications'
        ];
    }

    public function broadcastedNotifications($event)
    {
        if($event['type'] == MessageSent::class) {

            if ($event['conversation_id'] == $this->selectedConversation->id) {
                
                $this->dispatch('scroll-bottom');

                $newMessage = Message::find($event['message_id']);

                #push du message
                $this->loadedMessages->push($newMessage);

                #Marquer comme lu
                $newMessage->read_at = now();
                $newMessage->save();

                #Broadcast
                $this->selectedConversation->getReceiver()
                    ->notify(new MessageRead($this->selectedConversation->id));
            }

        }
    }

    public function loadMore() : void
    {
        //Incrémente
        $this->paginate_var += 10;

        //Appel de la méthode loadMessages()
        $this->loadMessages();

        #Modifier la hauteur du chat
        $this->dispatch('update-chat-height');
    }

    public function loadMessages()
    {
        #Faire le compte
        $count = Message::where('conversation_id', $this->selectedConversation->id)->count();

        $this->loadedMessages = Message::where('conversation_id', $this->selectedConversation->id)
        ->skip($count-$this->paginate_var)
        ->take($this->paginate_var)
        ->get();

        $this->dispatch('update-chat-height');
    }

    public function sendMessage()
    {
        $this->validate([
            'body' =>'required|string'
        ],[
            'body.required' => 'Aucun message. Veuillez entrer un message a envoyé'
        ]);

        $createdMessage = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->selectedConversation->getReceiver()->id,
            'body' => $this->body,
        ]);

        $this->reset('body');

        //scrolle du message
        $this->dispatch('scroll-bottom');

        #Push du message
        $this->loadedMessages->push($createdMessage);

        #Editer conversation
        $this->selectedConversation->updated_at = now();
        $this->selectedConversation->save();

        #Rafraichir la liste de chat
        $this->emit('refresh')->to('chat.chat-list');

        $this->selectedConversation->getReceiver()
                ->notify(new MessageSent(
                    Auth()->User(),
                    $createdMessage,
                    $this->selectedConversation,
                    $this->selectedConversation->getReceiver()->id
                ));
    }

    public function mount()
    {
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.chat.chat-box')
        ->layout('layouts.app');
    }
}
