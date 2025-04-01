<?php

namespace App\Jobs;

use App\Events\EnviaMensagemEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessMensagemJob implements ShouldQueue
{
    use Queueable;


    public $mensagem;

    public function __construct($mensagem)
    {

        $this->mensagem = $mensagem;
    }


    public function handle(): void
    {
        EnviaMensagemEvent::dispatch($this->mensagem);
    }
}
