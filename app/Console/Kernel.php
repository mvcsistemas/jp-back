<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('queue:work  --stop-when-empty')->everyMinute()->withoutOverlapping();

        // App:periodo-aberto-feedback - todas as sextas 00:00
        $schedule->command('app:periodo-aberto-feedback')
            ->weeklyOn(5, '0:00'); // O dia da semana é 5 para sexta-feira (0 é domingo)

        // App:ultimo-dia-para-responder-feedback - todas as terças 00:00
        $schedule->command('app:ultimo-dia-para-responder-feedback')
            ->weeklyOn(2, '0:00'); // O dia da semana é 2 para terça-feira

        // App:alunos-com-treino-futuro - todo dia 00:00
        $schedule->command('app:alunos-com-treino-futuro')->daily();

        // App:alunos-necessitam-responder-feedback - de sexta até terça
        $schedule->command('app:alunos-necessitam-responder-feedback')
            ->cron('0 0 * * 5-2'); // Executa de sexta a terça à meia-noite (0:00)
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
