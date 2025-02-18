<?php

namespace Database\Seeders;

use App\Models\prueba_user;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class create_all_users_sigesp extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $empleado_sigesp = DB::connection('pgsql')->table('sno_personal')
            ->select('codemp', 'codper', 'cedper', 'nomper', 
                     'apeper', 'fecnacper', 'fecingadmpubper', 
                     'fecingper', 'telmovper', 'sexper',
                     'coreleper')
            ->get();
        foreach($empleado_sigesp as $empleado){

           prueba_user ::create([
                'codemp' => $empleado->codemp,
                'codper' => $empleado->codper,
                'cedper' => $empleado->cedper,
                'nomper' => $empleado->nomper,
                'apeper' => $empleado->apeper,
                'fecnacper' => $empleado->fecnacper,
                'fecingadmpubper' => $empleado->fecingadmpubper,
                'fecingper' => $empleado->fecingper,
                'telmovper' => $empleado->telmovper,
                'sexper' => $empleado->sexper,
                'coreleper' => $empleado->coreleper
            ]);
        }

    }
}
