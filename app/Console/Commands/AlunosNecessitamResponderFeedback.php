<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MVC\Models\Notificacao\NotificacaoService;

class AlunosNecessitamResponderFeedback extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:alunos-necessitam-responder-feedback';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $notificacao = new NotificacaoService();
        $notificacao->alunosNecessitamResponderFeedback();
    }
}
