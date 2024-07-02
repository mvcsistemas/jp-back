<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MVC\Models\Notificacao\Notificacao;
use MVC\Models\Notificacao\NotificacaoService;

class AlunosComTreinoFuturo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:alunos-com-treino-futuro';

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
        $model = new Notificacao();
        $notificacao = new NotificacaoService($model);
        $notificacao->alunosComTreinoFuturo();
    }
}
