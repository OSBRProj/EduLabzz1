<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EmailExampleCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email.example:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Do your actions here

        \Mail::send([], [], function($message) {


            $message
            ->from('contato@edulabzz.com.br', 'Suporte Jean Piaget')
            ->to('othon200@gmail.com')
            ->subject('Automatic Testing mails - ' . date("H:i d/m/Y"))
            // ->setBody('<h1>Hi, welcome user!</h1>', 'text/html'); // for HTML rich messages
            ->setBody('Apenas um e-mail de teste que deve ser enviado de tempos em tempos automáticamente!'); // assuming text/plain

        });

        $this->info('E-mail Example Cron comando rodando com êxito');
    }
}
