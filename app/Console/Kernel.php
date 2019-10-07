<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();


        // $schedule->call(function () {

        //     \Mail::send([], [], function($message) {


        //         $message
        //         ->from('contato@edulabzz.com.br', 'Suporte Jean Piaget')
        //         ->to('othon200@gmail.com')
        //         ->subject('Automatic Testing mails - ' . date("H:i d/m/Y"))
        //         // ->setBody('<h1>Hi, welcome user!</h1>', 'text/html'); // for HTML rich messages
        //         ->setBody('Apenas um e-mail de teste que deve ser enviado de tempos em tempos automáticamente!'); // assuming text/plain

        //     });

        // })
        // // ->everyMinute();
        // ->everyFiveMinutes();
        // // ->withoutOverlapping(); //So funciona se tiver name na schedule

        // $schedule->command('email.example:cron')->everyFiveMinutes();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
