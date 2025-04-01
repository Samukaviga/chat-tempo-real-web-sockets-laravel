<?php

namespace App\Livewire;

use App\Events\EnviaMensagemEvent;
use App\Events\UserStatusEvent;
use App\Jobs\ProcessMensagemJob;
use App\Models\Mensagem;
use App\Models\User;
use Livewire\Component;



class Chat extends Component
{

    public $mensagem = "";
    public $mensagens;
    public $users;


    protected $listeners = [
        'echo:envia.mensagem,EnviaMensagemEvent' => '$refresh',
        'echo:status,UserStatusEvent' => '$refresh',
    ];


    public function mount()
    {
        if (auth()->check()) {

            $user = auth()->user();
            $user->update(['status' => 1]);

            UserStatusEvent::dispatch($user->id, 1);
        }
    }


    public function enviarMensagem()
    {

        if ($this->mensagem !== "") {
            Mensagem::create([

                'mensagem' => $this->mensagem,
                'user_id' => auth()->user()->id,

            ]);

            EnviaMensagemEvent::dispatch();

            $this->mensagem = "";
        }
    }


    public function receberMensagem()
    {
        $this->mensagens = Mensagem::all();
    }


    public function render()
    {
        $this->users = User::all();

        $this->mensagens = Mensagem::all();

        return view('livewire.chat');
    }
}
