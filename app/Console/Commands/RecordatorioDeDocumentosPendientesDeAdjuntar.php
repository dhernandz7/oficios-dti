<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Asignacion;
use App\Notifications\RecordatorioDeDocumentosPendientesDeAdjuntarNotify;
use DB;

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
        $FECHA_COMIENZO_RECORDATORIO = '2021-03-09';
        //$ELMER_ID = 14;
        //$user = User::find($ELMER_ID);

        //$user->notify(new RecordatorioDeDocumentosPendientesDeAdjuntarNotify);

        $documentos_pendientes = Asignacion::
        join('tipo_documento AS td', 'asignaciones.tipo_documento_id', 'td.id')
        ->select([
            'asignaciones.id',
            'asignaciones.oficio_id',
            'asignaciones.oficio_anio',
            'asignaciones.user_id',
            'asignaciones.created_at',
            'td.tipo_documento',
            'td.prefijo'
        ])
        ->where('asignaciones.path', null)
        ->orderBy('asignaciones.oficio_anio', 'ASC')
        ->orderBy('asignaciones.tipo_documento_id', 'ASC')
        ->orderBy('asignaciones.oficio_id', 'ASC')
        ->get();

        $anteriores = $documentos_pendientes->where('created_at', '<', $FECHA_COMIENZO_RECORDATORIO);

        $actuales = $documentos_pendientes->where('created_at', '>=', $FECHA_COMIENZO_RECORDATORIO);

        $secretaria = User::where('departamento_id', 2)->first();

        $usuarios_actuales = User::
        join('asignaciones AS a', 'users.id', 'a.user_id')
        ->select(DB::raw('DISTINCT users.id, users.name, users.email, users.genero_id'))
        ->where('a.path', null)
        ->where('a.created_at', '>=', $FECHA_COMIENZO_RECORDATORIO)
        ->get();

        if(count($anteriores) > 0) {
            $secretaria->notify(new RecordatorioDeDocumentosPendientesDeAdjuntarNotify($anteriores));
        }

        foreach ($usuarios_actuales as $usuario) {
            $documentos_usuario = $actuales->where('user_id', $usuario->id);

            if(count($documentos_usuario) > 0) {
                $usuario->notify(new RecordatorioDeDocumentosPendientesDeAdjuntarNotify($documentos_usuario));
            }
        }
    }
}
