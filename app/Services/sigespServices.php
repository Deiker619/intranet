<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class sigespServices
{

    public function prueba()
    {
        dd('hola');
    }

    public function recibo_pago_sigesp()
    {
        $recibo_pago = DB::connection('pgsql')->table('sno_personal')

            ->join('sno_hpersonalnomina', function ($join) {
                $join->on('sno_hpersonalnomina.codemp', '=', 'sno_personal.codemp')
                    ->on('sno_hpersonalnomina.codper', '=', 'sno_personal.codper');
            })
            ->join('sno_hsalida', function ($join) {
                $join->on('sno_hpersonalnomina.codemp', '=', 'sno_hsalida.codemp')
                    ->on('sno_hpersonalnomina.codnom', '=', 'sno_hsalida.codnom')
                    ->on('sno_hpersonalnomina.anocur', '=', 'sno_hsalida.anocur')
                    ->on('sno_hpersonalnomina.codperi', '=', 'sno_hsalida.codperi')
                    ->on('sno_hpersonalnomina.codper', '=', 'sno_hsalida.codper');
            })
            ->join('sno_hunidadadmin', function ($join) {
                $join->on('sno_hpersonalnomina.codemp', '=', 'sno_hunidadadmin.codemp')
                    ->on('sno_hpersonalnomina.anocur', '=', 'sno_hunidadadmin.anocur')
                    ->on('sno_hpersonalnomina.codperi', '=', 'sno_hunidadadmin.codperi')
                    ->on('sno_hpersonalnomina.minorguniadm', '=', 'sno_hunidadadmin.minorguniadm')
                    ->on('sno_hpersonalnomina.ofiuniadm', '=', 'sno_hunidadadmin.ofiuniadm')
                    ->on('sno_hpersonalnomina.uniuniadm', '=', 'sno_hunidadadmin.uniuniadm')
                    ->on('sno_hpersonalnomina.depuniadm', '=', 'sno_hunidadadmin.depuniadm')
                    ->on('sno_hpersonalnomina.prouniadm', '=', 'sno_hunidadadmin.prouniadm');
            })
            ->join('sno_ubicacionfisica', function ($join) {
                $join->on('sno_hpersonalnomina.codemp', '=', 'sno_ubicacionfisica.codemp')
                    ->on('sno_hpersonalnomina.codubifis', '=', 'sno_ubicacionfisica.codubifis');
            })
            ->join('sno_hnomina', function ($join) {
                $join->on('sno_hpersonalnomina.codemp', '=', 'sno_hnomina.codemp')
                    ->on('sno_hpersonalnomina.codnom', '=', 'sno_hnomina.codnom')
                    ->on('sno_hpersonalnomina.anocur', '=', 'sno_hnomina.anocurnom')
                    ->on('sno_hpersonalnomina.codperi', '=', 'sno_hnomina.peractnom');
            })
            ->join('sno_hperiodo', function ($join) {
                $join->on('sno_hnomina.codemp', '=', 'sno_hperiodo.codemp')
                    ->on('sno_hnomina.codnom', '=', 'sno_hperiodo.codnom')
                    ->on('sno_hnomina.anocurnom', '=', 'sno_hperiodo.anocur')
                    ->on('sno_hnomina.peractnom', '=', 'sno_hperiodo.codperi');
            })
            ->select(
                'sno_personal.codper',
                DB::raw('MAX(sno_personal.cedper) as cedper'),
                DB::raw('MAX(sno_personal.nomper) as nomper'),
                DB::raw('MAX(sno_personal.apeper) as apeper'),
                DB::raw('MAX(sno_personal.nacper) as nacper'),
                DB::raw('MAX(sno_hpersonalnomina.codcueban) as codcueban'),
                DB::raw('MAX(sno_hpersonalnomina.tipcuebanper) as tipcuebanper'),
                DB::raw('MAX(sno_personal.fecingper) as fecingper'),
                'sno_hpersonalnomina.codperi',
                DB::raw('MAX(sno_hperiodo.fecdesper) as fecdesper'),
                DB::raw('MAX(sno_hperiodo.fechasper) as fechasper'),
                DB::raw('MAX(sno_personal.fecegrper) as fecegrper'),
                DB::raw('SUM(sno_hsalida.valsal) as total'),
                DB::raw('MAX(sno_personal.coreleper) as coreleper'),
                DB::raw('MAX(sno_hunidadadmin.desuniadm) as desuniadm'),
                DB::raw('MAX(sno_hpersonalnomina.sueper) as sueper'),
                DB::raw('MAX(sno_hpersonalnomina.pagbanper) as pagbanper'),
                DB::raw('MAX(sno_hpersonalnomina.pagefeper) as pagefeper'),
                DB::raw('MAX(sno_ubicacionfisica.desubifis) as desubifis'),
                DB::raw('MAX(sno_hnomina.desnom) as desnom'),
                DB::raw('MAX(sno_hpersonalnomina.sueintper) as sueintper'),
                DB::raw('MAX(sno_hpersonalnomina.codcar) as codcar'),
                DB::raw('MAX(sno_hpersonalnomina.codasicar) as codasicar'),
                DB::raw("(SELECT tipnom FROM sno_hnomina WHERE sno_hpersonalnomina.codnom = sno_hnomina.codnom AND sno_hpersonalnomina.codemp = sno_hnomina.codemp AND sno_hpersonalnomina.anocur = sno_hnomina.anocurnom AND sno_hpersonalnomina.codperi = sno_hnomina.peractnom) as tiponom"),
                DB::raw("(SELECT MAX(denasicar) FROM sno_hasignacioncargo WHERE sno_hpersonalnomina.codemp = sno_hasignacioncargo.codemp AND sno_hpersonalnomina.codnom = sno_hasignacioncargo.codnom AND sno_hpersonalnomina.anocur = sno_hasignacioncargo.anocur AND sno_hpersonalnomina.codasicar = sno_hasignacioncargo.codasicar) as denasicar"),
                DB::raw("(SELECT MAX(codgra) FROM sno_hasignacioncargo WHERE sno_hpersonalnomina.codemp = sno_hasignacioncargo.codemp AND sno_hpersonalnomina.codnom = sno_hasignacioncargo.codnom AND sno_hpersonalnomina.anocur = sno_hasignacioncargo.anocur AND sno_hpersonalnomina.codasicar = sno_hasignacioncargo.codasicar) as grado"),
                DB::raw("(SELECT MAX(descar) FROM sno_hcargo WHERE sno_hpersonalnomina.codemp = sno_hcargo.codemp AND sno_hpersonalnomina.codnom = sno_hcargo.codnom AND sno_hpersonalnomina.anocur = sno_hcargo.anocur AND sno_hpersonalnomina.codcar = sno_hcargo.codcar AND sno_hpersonalnomina.codperi = sno_hcargo.codperi) as descar"),
                'sno_hnomina.codnom'
            )
            ->where('sno_hsalida.codemp', '0001')
            ->whereNotIn('sno_hsalida.tipsal', ['P2', 'V4', 'W4'])
            ->where('sno_hperiodo.fecdesper', 'LIKE', '2023-01-01%')
            ->where('sno_hperiodo.fechasper', 'LIKE', '2023-01-15%')
            ->where('sno_hpersonalnomina.codper', '0009578434')
            ->whereBetween('sno_hpersonalnomina.codnom', ['0400', '0400'])
            ->where('sno_hsalida.valsal', '<>', 0)
            ->whereIn('sno_hsalida.tipsal', ['A', 'V1', 'W1', 'D', 'V2', 'W2', 'P1', 'V3', 'W3'])
            ->groupBy(
                'sno_hpersonalnomina.codemp',
                'sno_hpersonalnomina.codnom',
                'sno_hnomina.codnom',
                'sno_hpersonalnomina.codperi',
                'sno_personal.codper',
                'sno_hpersonalnomina.codcar',
                'sno_hpersonalnomina.codasicar',
                'sno_hpersonalnomina.anocur',
                'sno_hpersonalnomina.codban',
                'sno_personal.codorg'
            )
            ->orderBy('sno_personal.codper')
            ->orderBy('sno_hpersonalnomina.codperi')
            ->get();

        return $recibo_pago;
    }

    public function periodos()
    {
        $periodos = DB::connection('pgsql')->table('sno_hperiodo')
            ->select('fecdesper')
            ->orderBy('codemp')
            ->orderBy('codnom')
            ->orderBy('anocur')
            ->orderBy('codperi')
            ->where('codnom', '0400')
            ->get();
        return $periodos;
    }
    public function periodos_por_fecdesper($fecdesper)
    {
        $periodos = DB::connection('pgsql')->table('sno_hperiodo')
            ->select('fechasper')
            ->orderBy('codemp')
            ->orderBy('codnom')
            ->orderBy('anocur')
            ->orderBy('codperi')
            ->where('fecdesper', $fecdesper)
            ->get();
        return $periodos;
    }
}
