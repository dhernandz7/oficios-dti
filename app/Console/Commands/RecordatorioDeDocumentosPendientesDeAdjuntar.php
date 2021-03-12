<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Notifications\RecordatorioDeDocumentosPendientesDeAdjuntarNotify;

class RecordatorioDeDocumentosPendientesDeAdjuntar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dti:recordatorio-pendientes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía correo electrónico a la secretaria con listado de documentos pendientes de adjuntar';

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
        $ELMER_ID = 14;
        $user = User::find($ELMER_ID);

        $user->notify(new RecordatorioDeDocumentosPendientesDeAdjuntarNotify);
    }
}
