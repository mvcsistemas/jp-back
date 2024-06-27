<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MVC\Models\Notificacao\NotificacaoService;

class PeriodoAbertoFeedback extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:periodo-aberto-feedback';

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
        $notificacao->periodoAbertoFeedback();
    }
}
