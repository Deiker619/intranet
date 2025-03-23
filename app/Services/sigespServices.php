<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class sigespServices
{

    public function recibo_pago_sigesp($fechadesper, $fechasper, $codper)
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
            ->where('sno_hperiodo.fecdesper', 'LIKE', $fechadesper . '%') //Se necesita
            ->where('sno_hperiodo.fechasper', 'LIKE', $fechasper . '%') //Se necesita
            ->where('sno_hpersonalnomina.codper', $codper) //Se necesita
            ->whereIn('sno_hpersonalnomina.codnom', ['0401', '0400', '0402'])
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


    /* 
        ** Conceptos 
    
    */
    public function get_constante()
    {
        $conceptos = DB::connection('pgsql')->table('sno_constante')
            ->select('codcons', 'nomcon', 'valcon')->where([
                ['codemp', '0001'],
                ['codnom', '0502'],
                ['codcons', '0000000001']
                ])
            ->get();
        return $conceptos;
    }

    public function getPeriodos()
    {
        return DB::connection('pgsql')->table('sno_hperiodo')
            ->select(DB::raw("DISTINCT(CONCAT(EXTRACT(MONTH FROM fecdesper),'-',EXTRACT(YEAR FROM fecdesper) )) AS periodo"))
            ->get();

    }

    public function getConstanciaTrabajo($cedula)
    {
        Carbon::setLocale('es');

        //para validar si mostrar o no remuneracion o cesta tickes
        $options = [
            'remuneracion' => '$request->remuneracion,',
            'ticket' => '$request->ticket'
        ];
        $codper=str_pad($cedula, 10, "0", STR_PAD_LEFT);//se completa con 10 ceros a la izquierda
        $periodoNom =env('NUMERO_PERIODO_NOMINA')??'040';

        $usigesp = DB::connection('pgsql')->table('sno_personal')
            ->where('cedper', $cedula)
            ->first();

        if ($usigesp == null) {
            return response()->json([
                'message' => 'El usuario no se encuentra registrado en nomina'
            ], 404);
        }

        $ultPeriodo = DB::connection('pgsql')->table('sno_hperiodo')
            ->distinct('codperi')
            ->select([
                'codperi',
            ])
            ->orderBy('codperi', 'asc')
            ->get()
            ->last();

        $numPeri = 0;

        $personal = null;

        do {
            $personal = DB::connection('pgsql')->table('sno_personal')
                ->where('sno_personal.codemp', '0001')
                ->where('sno_hpersonalnomina.codnom', '=', "$periodoNom$numPeri")
                ->whereBetween('sno_personal.codper', [$codper, $codper]) 
                ->where('sno_hperiodo.codperi', $ultPeriodo->codperi)
                ->join('sno_hpersonalnomina', function ($join) {
                    $join->on('sno_personal.codemp', '=', 'sno_hpersonalnomina.codemp')
                        ->on('sno_personal.codper', '=', 'sno_hpersonalnomina.codper');
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
                ->join('sno_unidadadmin', function ($join) {
                    $join->on('sno_hpersonalnomina.codemp', '=', 'sno_unidadadmin.codemp')
                        ->on('sno_hpersonalnomina.minorguniadm', '=', 'sno_unidadadmin.minorguniadm')
                        ->on('sno_hpersonalnomina.ofiuniadm', '=', 'sno_unidadadmin.ofiuniadm')
                        ->on('sno_hpersonalnomina.uniuniadm', '=', 'sno_unidadadmin.uniuniadm')
                        ->on('sno_hpersonalnomina.depuniadm', '=', 'sno_unidadadmin.depuniadm')
                        ->on('sno_hpersonalnomina.prouniadm', '=', 'sno_unidadadmin.prouniadm');
                })
                ->join('sno_dedicacion', function ($join) {
                    $join->on('sno_hpersonalnomina.codemp', '=', 'sno_dedicacion.codemp')
                        ->on('sno_hpersonalnomina.codded', '=', 'sno_dedicacion.codded');
                })
                ->join('sno_tipopersonal', function ($join) {
                    $join->on('sno_hpersonalnomina.codemp', '=', 'sno_tipopersonal.codemp')
                        ->on('sno_hpersonalnomina.codded', '=', 'sno_tipopersonal.codded')
                        ->on('sno_hpersonalnomina.codtipper', '=', 'sno_tipopersonal.codtipper');
                })
                ->join('srh_gerencia', function ($join) {
                    $join->on('sno_personal.codemp', '=', 'srh_gerencia.codemp')
                        ->on('sno_personal.codger', '=', 'srh_gerencia.codger');
                })
                ->select([
                    'sno_personal.codper',
                    'sno_personal.cedper',
                    'sno_personal.nomper',
                    'sno_personal.apeper',
                    'sno_personal.fecingper',
                    'sno_personal.dirper',
                    'sno_personal.fecnacper',
                    'sno_personal.edocivper',
                    'sno_personal.nacper',
                    'sno_personal.telhabper',
                    'sno_personal.telmovper',
                    'sno_hpersonalnomina.sueper',
                    DB::raw("(SELECT descar FROM sno_cargo WHERE sno_hpersonalnomina.codemp='0001' AND sno_hpersonalnomina.codnom='$periodoNom$numPeri' AND sno_hpersonalnomina.codemp = sno_cargo.codemp AND sno_hpersonalnomina.codnom = sno_cargo.codnom AND sno_hpersonalnomina.codcar = sno_cargo.codcar) as descar"),
                    'sno_hpersonalnomina.horper',
                    'sno_hpersonalnomina.sueintper',
                    'sno_hpersonalnomina.sueproper',
                    'sno_personal.fecegrper',
                    'sno_unidadadmin.desuniadm',
                    'sno_dedicacion.desded',
                    'sno_tipopersonal.destipper',
                    'sno_hnomina.tipnom',
                    'sno_personal.fecjubper',
                    'sno_hpersonalnomina.salnorper',
                    'srh_gerencia.denger',
                    'sno_hpersonalnomina.descasicar',
                    'sno_hpersonalnomina.fecingper AS fecingnom',
                    'sno_hpersonalnomina.staper',
                    'sno_hperiodo.codperi'
                ])
                ->groupBy([
                    'sno_personal.codper',
                    'sno_personal.cedper',
                    'sno_personal.nomper',
                    'sno_personal.apeper',
                    'sno_personal.fecingper',
                    'sno_personal.dirper',
                    'sno_personal.fecnacper',
                    'sno_personal.edocivper',
                    'sno_personal.nacper',
                    'sno_personal.telhabper',
                    'sno_personal.telmovper',
                    'sno_hpersonalnomina.sueper',
                    'sno_hpersonalnomina.horper',
                    'sno_hpersonalnomina.sueintper',
                    'sno_hpersonalnomina.sueproper',
                    'sno_unidadadmin.desuniadm',
                    'sno_dedicacion.desded',
                    'sno_tipopersonal.destipper',
                    'sno_hpersonalnomina.codemp',
                    'sno_hpersonalnomina.codnom',
                    'sno_hpersonalnomina.codcar',
                    'sno_hpersonalnomina.codasicar',
                    'sno_personal.fecegrper',
                    'sno_hnomina.tipnom',
                    'sno_personal.fecjubper',
                    'sno_hpersonalnomina.salnorper',
                    'srh_gerencia.denger',
                    'sno_hpersonalnomina.descasicar',
                    'sno_hpersonalnomina.fecingper',
                    'sno_hpersonalnomina.staper',
                    'sno_hperiodo.codperi',
                ])
                ->orderBy('sno_personal.cedper')
                ->get()
                ->first();

            $numPeri += 1;
        } while ($personal == null && $numPeri != 4);

        if ($personal == null) {
            return response()->json([
                'message' => 'El último período de nómina no se encuentra cerrado o el usuario no se encuentra registrado en nómina, comuníquese con la unidad de recursos humanos'
            ], 423);
        }

        if ($personal->staper != 1) {
            return response()->json([
                'message' => 'El usuario no se encuentra activo en nomina, comuníquese con la unidad de recursos humanos'
            ], 403);
        }

        $numPeri -= 1;

        $constancia = DB::connection('pgsql')->table('sno_constanciatrabajo')
            ->where('sno_constanciatrabajo.codemp', '0001')
            ->where('sno_constanciatrabajo.codcont', '001')
            ->whereRaw("codemp IN (SELECT codemp FROM sno_personalnomina WHERE  sno_personalnomina.codnom = '$periodoNom$numPeri' AND sno_personalnomina.codper>='$codper' AND sno_personalnomina.codper<='$codper')")
            ->select([
                'sno_constanciatrabajo.codcont',
                'sno_constanciatrabajo.descont',
                'sno_constanciatrabajo.concont',
                'sno_constanciatrabajo.tamletcont',
                'sno_constanciatrabajo.intlincont',
                'sno_constanciatrabajo.marinfcont',
                'sno_constanciatrabajo.marsupcont',
                'sno_constanciatrabajo.titcont',
                'sno_constanciatrabajo.piepagcont',
                'sno_constanciatrabajo.tamletpiecont',
                'sno_constanciatrabajo.arcrtfcont',
               // 'sno_constanciatrabajo.consumcont'
            ])
            ->get()
            ->first();

        $date = new Carbon($personal->fecingper);

        $endDate = Carbon::now();
        $endDate = $endDate->addMonths(3);

        $expira = $endDate->day > 1 ? $endDate->day . ' días del mes de ' . $endDate->monthName . ' de ' . $endDate->year
            : 'el primer día del mes de ' . $endDate->monthName . ' de ' . $endDate->year;

        $ls_cedula = number_format($personal->codper, 0, ',', '.');
        $ls_nombres = $personal->nomper;
        $ls_apellidos = $personal->apeper;
        $ls_cargo = $personal->descar;
        $ld_fecha_ingreso = $date->format('d/m/Y');
        $ls_unidad_administrativa = $personal->desuniadm;
        $li_normalmensual = number_format($personal->sueper, 2, ',', '.');
        $ls_dia = now()->day;
        $ls_mes = now()->monthName;
        $ls_ano = now()->year;
        $ls_gerencia= $personal->desuniadm;
        $i_sueldo=$personal->sueper;
        //$constancia->concont
      
        $const = mb_convert_encoding($constancia->concont, 'ISO-8859-15', 'UTF-8');
       
        $constFinal = str_replace("JOSÃ", "JOSÉ", $const);
        $constFinal = str_replace("GestiÃ³n", "Gestión", $constFinal);
        $constFinal = str_replace("Cï¿œdula", "Cédula", $constFinal);
        $constFinal = str_replace("Identidad Nï¿œ", "Identidad N°", $constFinal);
        $constFinal = str_replace("instituciï¿œn", "Institución", $constFinal);
        $constFinal = str_replace("Ademï¿œs", "Además", $constFinal);
        $constFinal = str_replace("Alimentaciï¿œn", "Alimentación", $constFinal);
        $constFinal = str_replace("Cï¿œntimos", "Céntimos", $constFinal);
        $constFinal = str_replace("Nï¿œ", "N°", $constFinal);
        $constFinal = str_replace("dÃ\u{AD}as", "días", $constFinal);
        $constFinal = str_replace("Gestiï¿œn", "Gestión", $constFinal);


        if ($ls_dia == 1) {
            $constFinal = str_replace('a los $ls_dia días', 'el día $ls_dia', $constFinal);
        }

        $constFinal = eval("return nl2br(\"$constFinal\");"); 
        // Convertir a UTF-8 antes de devolver la respuesta
        $constFinal = mb_convert_encoding($constFinal, 'UTF-8', 'ISO-8859-15');

        $data = [
            'codigo' => $personal->codper,
            'nombre' => $personal->nomper,
            'apellido' => $personal->apeper,
            'cargo' => $personal->descar,
            'fecing' => $date->format('d/m/Y'),
            'oficina' => $personal->desuniadm,
            'sueldo' => $personal->sueper,
            'expira' => $expira,
            'constancia' => $constFinal,
            'opciones' => $options,
        ];


        return response()->json([
            'data'=>compact('data'),
            'message' => 'Usuario encontrado'
        ], 200);
     
        
    }

    public function getReciboPago($cedula, $fecha)
    {
        $fecha=$fecha;
        $cedula=$cedula;

        $fecha = explode('-', $fecha);
     

        $usigesp = DB::connection('pgsql')->table('sno_personal')
        ->where('cedper', $cedula)
        ->first();

        if($usigesp == null)
        {
            return response()->json([
                'message' => 'El usuario no se encuentra registrado en nomina'
            ], 404);
        }

        $date = new Carbon("1-$fecha[0]-$fecha[1]");
      
        $priPeriodo = DB::connection('pgsql')->table('sno_hperiodo')
        ->where('fecdesper', $date->format('Y-m-d'))
        ->distinct('codperi')
        ->select([
            'codperi',
            'fecdesper',
            'fechasper'
        ])
        ->orderBy('codperi', 'asc')
        ->get()
        ->last();
        

        $segPeriodo = DB::connection('pgsql')->table('sno_hperiodo')
        ->where('fecdesper', $date->addDays(15)->format('Y-m-d'))
        ->distinct('codperi')
        ->select([
            'codperi',
            'fecdesper',
            'fechasper'
        ])
        ->orderBy('codperi', 'asc')
        ->get()
        ->last();

        if($this->personalPeriodo($segPeriodo,$cedula) != null)
        {
            $priQuincena =  $this->personalPeriodo($priPeriodo,$cedula);
            $segQuincena = $this->personalPeriodo($segPeriodo,$cedula);

            $data =[
                'primera-quincena' => $priQuincena,
                'segunda-quincena' => $segQuincena,
            ];

            return response()->json([
                'data'=>$data,
                'message' => 'Registro encontrado'
            ], 200);

        }else if($this->personalPeriodo($priPeriodo,$cedula) != null){
            $priPeriodo = $this->personalPeriodo($priPeriodo,$cedula);
            $data =[
                'priPeriodo' => $priPeriodo,
            ];
            return response()->json([
                'data'=>$data,
                'message' => 'Registro encontrado'
            ], 200);
        }else{
            
            return response()->json([
                'message' => 'El último período de nómina no se encuentra cerrado o el usuario no se encuentra registrado en nómina, comuníquese con la unidad de recursos humanos'
            ], 423);
        }

        //return view('pdf.sigesp.recpago', compact('personal', 'asignaciones', 'deducciones'));
    }
    public function personalPeriodo($periodo,$cedula)
    {

        if($periodo == null)
        {
            return null;
        }

        $fecdesper = new Carbon($periodo->fecdesper);
        $fechasper = new Carbon($periodo->fechasper);
        $codper=str_pad($cedula, 10, "0", STR_PAD_LEFT);//se completa con 10 ceros a la izquierda
        $periodoNom =env('NUMERO_PERIODO_NOMINA')??'040';
     
        $periodoCustm = [
            'codperi' => $periodo->codperi,
            'fecdesper' => $fecdesper->format('d/m/Y'),
            'fechasper' => $fechasper->format('d/m/Y'),
        ];
         
        $numPeri = 0;

        $personal = null;
      
        do{ 
            
            $personal = DB::connection('pgsql')->table('sno_personal')
            ->distinct('sno_personal.codper')
            ->where('sno_hsalida.codemp', '=', '0001')
            ->where('sno_hperiodo.fecdesper','>=', $periodo->fecdesper)
            ->where('sno_hperiodo.fechasper','<=',$periodo->fechasper)
            ->where('sno_hpersonalnomina.codnom','=',"$periodoNom$numPeri")
            ->where('sno_hpersonalnomina.codper','>=',"$codper")
            ->where('sno_hpersonalnomina.codper','<=',"$codper")
            ->where('sno_hsalida.valsal','<>',0)
            ->whereRaw("(sno_hsalida.tipsal<>'P2' AND sno_hsalida.tipsal<>'V4' AND sno_hsalida.tipsal<>'W4')")
            ->whereRaw("(sno_hsalida.tipsal='A' OR sno_hsalida.tipsal='V1' OR sno_hsalida.tipsal='W1' OR sno_hsalida.tipsal='D' OR sno_hsalida.tipsal='V2' OR sno_hsalida.tipsal='W2' OR sno_hsalida.tipsal='P1' OR sno_hsalida.tipsal='V3' OR sno_hsalida.tipsal='W3')")
            //sno_hpersonalnomina
            //sno_personal.codemp = sno_hpersonalnomina.codemp
            //sno_personal.codper = sno_hpersonalnomina.codper
            ->join('sno_hpersonalnomina', function ($join) {
                $join->on('sno_personal.codemp', '=', 'sno_hpersonalnomina.codemp')
                    ->on('sno_personal.codper', '=', 'sno_hpersonalnomina.codper');
            })
            //sno_hunidadadmin
            //sno_hpersonalnomina.codemp = sno_hunidadadmin.codemp
            //sno_hpersonalnomina.anocur = sno_hunidadadmin.anocur
            //sno_hpersonalnomina.codperi = sno_hunidadadmin.codperi
            //sno_hpersonalnomina.minorguniadm = sno_hunidadadmin.minorguniadm
            //sno_hpersonalnomina.ofiuniadm = sno_hunidadadmin.ofiuniadm
            //sno_hpersonalnomina.uniuniadm = sno_hunidadadmin.uniuniadm
            //sno_hpersonalnomina.depuniadm = sno_hunidadadmin.depuniadm
            //sno_hpersonalnomina.prouniadm = sno_hunidadadmin.prouniadm
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
            //sno_hsalida
            //sno_hpersonalnomina.codemp = sno_hsalida.codemp
            //sno_hpersonalnomina.codnom = sno_hsalida.codnom
            //sno_hpersonalnomina.anocur = sno_hsalida.anocur
            //sno_hpersonalnomina.codperi = sno_hsalida.codperi
            //sno_hpersonalnomina.codper = sno_hsalida.codper
            ->join('sno_hsalida', function ($join) {
                $join->on('sno_hpersonalnomina.codemp', '=', 'sno_hsalida.codemp')
                    ->on('sno_hpersonalnomina.codnom', '=', 'sno_hsalida.codnom')
                    ->on('sno_hpersonalnomina.anocur', '=', 'sno_hsalida.anocur')
                    ->on('sno_hpersonalnomina.codperi', '=', 'sno_hsalida.codperi')
                    ->on('sno_hpersonalnomina.codper', '=', 'sno_hsalida.codper');
            })
            //sno_hnomina
            //sno_hpersonalnomina.codemp = sno_hnomina.codemp
            //sno_hpersonalnomina.codnom = sno_hnomina.codnom
            //sno_hpersonalnomina.anocur = sno_hnomina.anocurnom
            //sno_hpersonalnomina.codperi = sno_hnomina.peractnom
            ->join('sno_hnomina', function ($join) {
                $join->on('sno_hpersonalnomina.codemp', '=', 'sno_hnomina.codemp')
                    ->on('sno_hpersonalnomina.codnom', '=', 'sno_hnomina.codnom')
                    ->on('sno_hpersonalnomina.anocur', '=', 'sno_hnomina.anocurnom')
                    ->on('sno_hpersonalnomina.codperi', '=', 'sno_hnomina.peractnom');
            })
            //sno_hperiodo
            //sno_hnomina.codemp = sno_hperiodo.codemp
            //sno_hnomina.codnom = sno_hperiodo.codnom
            //sno_hnomina.anocurnom = sno_hperiodo.anocur
            //sno_hnomina.peractnom = sno_hperiodo.codperi
            ->join('sno_hperiodo', function ($join) {
                $join->on('sno_hnomina.codemp', '=', 'sno_hperiodo.codemp')
                    ->on('sno_hnomina.codnom', '=', 'sno_hperiodo.codnom')
                    ->on('sno_hnomina.anocurnom', '=', 'sno_hperiodo.anocur')
                    ->on('sno_hnomina.peractnom', '=', 'sno_hperiodo.codperi');
            })
            //sno_ubicacionfisica
            //sno_hpersonalnomina.codemp = sno_ubicacionfisica.codemp
            //sno_hpersonalnomina.codubifis = sno_ubicacionfisica.codubifis
            ->join('sno_ubicacionfisica', function ($join) {
                $join->on('sno_hpersonalnomina.codemp', '=', 'sno_ubicacionfisica.codemp')
                    ->on('sno_hpersonalnomina.codubifis', '=', 'sno_ubicacionfisica.codubifis');
            })
            ->select(
                'sno_hnomina.codnom',
                DB::raw('MAX(sno_personal.cedper) as cedper'),
                DB::raw('MAX(sno_personal.nomper) as nomper'),
                DB::raw('MAX(sno_personal.apeper) as apeper'),
                DB::raw('MAX(sno_personal.nacper) as nacper'),
                DB::raw('MAX(sno_hpersonalnomina.codcueban) AS codcueban'),
                DB::raw('MAX(sno_hpersonalnomina.tipcuebanper) as tipcuebanper'),
                DB::raw('MAX(sno_personal.fecleypen) AS fecleypen'),
                DB::raw('MAX(sno_personal.fecingper) as fecingper'),
                DB::raw('MAX(sno_personal.fecegrper) as fecegrper'),
                DB::raw('MAX(sno_personal.rifper) as rifper'),
                DB::raw('SUM(sno_hsalida.valsal) as total'),
                DB::raw('MAX(sno_personal.coreleper) AS coreleper'),
                DB::raw('MAX(sno_hpersonalnomina.salnorper) AS salnorper'),
                DB::raw('MAX(sno_hunidadadmin.desuniadm) as desuniadm'),
                DB::raw('MAX(sno_hpersonalnomina.fecingper) AS fecingnom'),
                DB::raw('MAX(sno_hpersonalnomina.fecculcontr) AS fecculcontr'),
                DB::raw('MAX(sno_hunidadadmin.minorguniadm) as minorguniadm'),
                DB::raw('MAX(sno_hunidadadmin.ofiuniadm) AS ofiuniadm'),
                DB::raw('MAX(sno_hunidadadmin.uniuniadm) AS uniuniadm'),
                DB::raw('MAX(sno_hunidadadmin.depuniadm) as depuniadm'),
                DB::raw('MAX(sno_hunidadadmin.prouniadm) AS prouniadm'),
                DB::raw('MAX(sno_hpersonalnomina.sueper) AS sueper'),
                DB::raw('MAX(sno_hpersonalnomina.pagbanper) AS pagbanper'),
                DB::raw('MAX(sno_hpersonalnomina.pagefeper) AS pagefeper'),
                DB::raw('MAX(sno_ubicacionfisica.desubifis) AS desubifis'),
                DB::raw('MAX(sno_hnomina.desnom) AS desnom'),
                DB::raw('MAX(sno_hnomina.racnom) AS racnom'),
                DB::raw('MAX(sno_personal.codorg) as codorg'),
                DB::raw('MAX(sno_hnomina.adenom) AS adenom'),
                DB::raw('MAX(sno_hpersonalnomina.sueintper) AS sueintper'),
                DB::raw('MAX(sno_hpersonalnomina.codcar) AS codcar'),
                DB::raw('MAX(sno_hpersonalnomina.codasicar) AS codasicar'),
                DB::raw('MAX(sno_hpersonalnomina.descasicar) AS descasicar'),
                DB::raw('MAX(sno_hpersonalnomina.staper) AS staper'),
                DB::raw('MAX(sno_hpersonalnomina.obsrecper) as obsrecper'),
                DB::raw("MAX((SELECT destipper FROM sno_tipopersonal WHERE sno_hpersonalnomina.codded = sno_tipopersonal.codded AND sno_hpersonalnomina.codtipper = sno_tipopersonal.codtipper)) AS destipper"),
                DB::raw("MAX((SELECT desest FROM sigesp_estados WHERE sigesp_estados.codpai = sno_ubicacionfisica.codpai AND sigesp_estados.codest = sno_ubicacionfisica.codest)) AS desest"),
                DB::raw("MAX((SELECT tipnom FROM sno_hnomina WHERE sno_hpersonalnomina.codnom = sno_hnomina.codnom AND sno_hpersonalnomina.codemp = sno_hnomina.codemp AND sno_hpersonalnomina.anocur=sno_hnomina.anocurnom AND sno_hpersonalnomina.codperi=sno_hnomina.peractnom)) AS tiponom"),
                DB::raw("MAX((SELECT suemin FROM sno_hclasificacionobrero WHERE sno_hclasificacionobrero.codnom = sno_hpersonalnomina.codnom AND sno_hclasificacionobrero.grado = sno_hpersonalnomina.grado AND sno_hclasificacionobrero.codemp = sno_hpersonalnomina.codemp AND sno_hclasificacionobrero.codperi = sno_hpersonalnomina.codperi AND sno_hclasificacionobrero.anocur = sno_hpersonalnomina.anocur)) AS sueobr"),
                DB::raw("MAX((SELECT denmun FROM sigesp_municipio WHERE sigesp_municipio.codpai = sno_ubicacionfisica.codpai AND sigesp_municipio.codest = sno_ubicacionfisica.codest AND sigesp_municipio.codmun = sno_ubicacionfisica.codmun)) AS denmun"),
                DB::raw("MAX((SELECT denpar FROM sigesp_parroquia WHERE sigesp_parroquia.codpai = sno_ubicacionfisica.codpai AND sigesp_parroquia.codest = sno_ubicacionfisica.codest AND sigesp_parroquia.codmun = sno_ubicacionfisica.codmun AND sigesp_parroquia.codpar = sno_ubicacionfisica.codpar)) AS denpar"),
                DB::raw("MAX((SELECT nomban FROM scb_banco WHERE scb_banco.codemp = sno_hpersonalnomina.codemp AND scb_banco.codban = sno_hpersonalnomina.codban)) AS banco"),
                DB::raw("MAX((SELECT MAX(nomage) FROM scb_agencias WHERE scb_agencias.codemp = sno_hpersonalnomina.codemp AND scb_agencias.codban = sno_hpersonalnomina.codban AND scb_agencias.codage = sno_hpersonalnomina.codage)) AS agencia"),
                DB::raw("MAX((SELECT MAX(denasicar) FROM sno_hasignacioncargo WHERE sno_hpersonalnomina.codemp = sno_hasignacioncargo.codemp AND sno_hpersonalnomina.codnom = sno_hasignacioncargo.codnom AND sno_hpersonalnomina.anocur = sno_hasignacioncargo.anocur AND sno_hpersonalnomina.codperi = sno_hasignacioncargo.codperi AND sno_hpersonalnomina.codasicar = sno_hasignacioncargo.codasicar)) as denasicar"),
                DB::raw("MAX((SELECT MAX(descar) FROM sno_hcargo WHERE sno_hpersonalnomina.codemp = sno_hcargo.codemp AND sno_hpersonalnomina.codnom = sno_hcargo.codnom AND sno_hpersonalnomina.anocur = sno_hcargo.anocur AND sno_hpersonalnomina.codcar = sno_hcargo.codcar AND sno_hpersonalnomina.codperi = sno_hcargo.codperi)) as descar"),
                DB::raw("MAX((SELECT sno_categoria_rango.descat FROM sno_rango, sno_categoria_rango WHERE sno_rango.codemp=sno_personal.codemp AND sno_rango.codcom=sno_personal.codcom AND sno_rango.codran=sno_personal.codran AND sno_categoria_rango.codcat=sno_rango.codcat)) AS descat"),
            )
            ->groupBy([
                'sno_hpersonalnomina.codemp',
                'sno_hpersonalnomina.codnom',
                'sno_hnomina.codnom',
                'sno_personal.codper',
                'sno_hpersonalnomina.anocur',
            ])
            ->orderBy('sno_personal.codper')
            ->get()
            ->first();

            $numPeri += 1;

          
        }while($personal == null && $numPeri != 5);
        $numPeri -= 1;
 
        $denominacion_union = DB::connection('pgsql')->table('sno_hconcepto')
        ->where('sno_hsalida.codemp','=','0001')
        ->where('sno_hsalida.codper','=',"$codper")
        ->where('sno_hperiodo.fecdesper','>=',$periodo->fecdesper)
        ->where('sno_hperiodo.fechasper','<=',$periodo->fechasper)
        ->where('sno_hsalida.codnom','=',"$periodoNom$numPeri")
        ->where('sno_hsalida.valsal','<>',0)
        ->whereRaw("(sno_hsalida.tipsal='A' OR sno_hsalida.tipsal='V1' OR sno_hsalida.tipsal='W1' OR sno_hsalida.tipsal='D' OR sno_hsalida.tipsal='V2' OR sno_hsalida.tipsal='W2' OR sno_hsalida.tipsal='P1' OR sno_hsalida.tipsal='V3' OR sno_hsalida.tipsal='W3')")
        //sno_hsalida
        //sno_hconcepto.codemp = sno_hsalida.codemp
        //sno_hconcepto.codnom = sno_hsalida.codnom
        //sno_hconcepto.anocur = sno_hsalida.anocur
        //sno_hconcepto.codperi = sno_hsalida.codperi
        //sno_hconcepto.codconc = sno_hsalida.codconc
        ->join('sno_hsalida', function ($join) {
            $join->on('sno_hconcepto.codemp', '=', 'sno_hsalida.codemp')
                ->on('sno_hconcepto.codnom', '=','sno_hsalida.codnom')
                ->on('sno_hconcepto.anocur', '=','sno_hsalida.anocur')
                ->on('sno_hconcepto.codperi', '=','sno_hsalida.codperi')
                ->on( 'sno_hconcepto.codconc', '=','sno_hsalida.codconc');
        })
        //sno_hperiodo
        //sno_hsalida.codemp = sno_hperiodo.codemp
        //sno_hsalida.codnom = sno_hperiodo.codnom
        //sno_hsalida.anocur = sno_hperiodo.anocur
        //sno_hsalida.codperi = sno_hperiodo.codperi
        ->join('sno_hperiodo', function ($join) {
            $join->on('sno_hsalida.codemp', '=', 'sno_hperiodo.codemp')
                ->on('sno_hsalida.codnom', '=', 'sno_hperiodo.codnom')
                ->on('sno_hsalida.anocur', '=', 'sno_hperiodo.anocur')
                ->on('sno_hsalida.codperi', '=', 'sno_hperiodo.codperi');
        })
        //sno_hconceptopersonal
        //sno_hsalida.codemp = sno_hconceptopersonal.codemp
        //sno_hsalida.codnom = sno_hconceptopersonal.codnom
        //sno_hsalida.anocur = sno_hconceptopersonal.anocur
        //sno_hsalida.codperi = sno_hconceptopersonal.codperi
        //sno_hsalida.codconc = sno_hconceptopersonal.codconc
        //sno_hsalida.codper = sno_hconceptopersonal.codper
        ->join('sno_hconceptopersonal', function ($join) {
            $join->on('sno_hsalida.codemp', '=', 'sno_hconceptopersonal.codemp')
                ->on('sno_hsalida.codnom', '=', 'sno_hconceptopersonal.codnom')
                ->on('sno_hsalida.anocur', '=', 'sno_hconceptopersonal.anocur')
                ->on('sno_hsalida.codperi', '=', 'sno_hconceptopersonal.codperi')
                ->on('sno_hsalida.codconc', '=', 'sno_hconceptopersonal.codconc')
                ->on('sno_hsalida.codper', '=', 'sno_hconceptopersonal.codper');
        })
        ->select(
            'sno_hconcepto.codconc',
            DB::raw("'' as codperi"),
            DB::raw("MAX(sno_hconcepto.titcon) as nomcon"),
            DB::raw("0 AS valsal"),
            DB::raw("MAX(sno_hsalida.tipsal) AS tipsal"),
            DB::raw("MAX(abs(sno_hconceptopersonal.acuemp)) AS acuemp"),
            DB::raw("MAX(abs(sno_hconceptopersonal.acupat)) AS acupat"),
            DB::raw("MAX(sno_hconcepto.repacucon) as repacucon"),
            DB::raw("MAX(sno_hconcepto.repconsunicon) AS repconsunicon"),
            DB::raw("MAX(sno_hconcepto.consunicon) AS consunicon"),
            DB::raw("MAX(sno_hconcepto.persalnor) AS persalnor"),
            DB::raw("0 AS unidad"),
            DB::raw("0 AS monacusal"),
        )
        ->groupBy([
            'sno_hconcepto.codemp',
            'sno_hconcepto.codnom',
            'sno_hconcepto.codconc',
        ])
        ->orderBy('codconc');

        $denominaciones = DB::connection('pgsql')->table('sno_hconcepto')
        ->where('sno_hsalida.codemp','=','0001')
        ->where('sno_hsalida.codper','=',"$codper")
        ->where('sno_hperiodo.fecdesper','>=',$periodo->fecdesper)
        ->where('sno_hperiodo.fechasper','<=',$periodo->fechasper)
        ->where('sno_hsalida.codnom','=',"$periodoNom$numPeri")
        ->where('sno_hsalida.valsal','<>','0')
        ->whereRaw("(sno_hsalida.tipsal='A' OR sno_hsalida.tipsal='V1' OR sno_hsalida.tipsal='W1' OR sno_hsalida.tipsal='D' OR sno_hsalida.tipsal='V2' OR sno_hsalida.tipsal='W2' OR sno_hsalida.tipsal='P1' OR sno_hsalida.tipsal='V3' OR sno_hsalida.tipsal='W3')")
        //sno_hsalida
        //sno_hsalida.codemp = sno_hconcepto.codemp
        //sno_hsalida.codnom = sno_hconcepto.codnom
        //sno_hsalida.anocur = sno_hconcepto.anocur
        //sno_hsalida.codperi = sno_hconcepto.codperi
        //sno_hsalida.codconc = sno_hconcepto.codconc
        ->join('sno_hsalida', function ($join) {
            $join->on('sno_hconcepto.codemp', '=', 'sno_hsalida.codemp')
                ->on('sno_hconcepto.codnom', '=','sno_hsalida.codnom')
                ->on('sno_hconcepto.anocur', '=','sno_hsalida.anocur')
                ->on('sno_hconcepto.codperi', '=','sno_hsalida.codperi')
                ->on( 'sno_hconcepto.codconc', '=','sno_hsalida.codconc');
        })
        //sno_hperiodo
        //sno_hsalida.codemp = sno_hperiodo.codemp
        //sno_hsalida.codnom = sno_hperiodo.codnom
        //sno_hsalida.anocur = sno_hperiodo.anocur
        //sno_hsalida.codperi = sno_hperiodo.codperi
        ->join('sno_hperiodo', function ($join) {
            $join->on('sno_hsalida.codemp', '=', 'sno_hperiodo.codemp')
                ->on('sno_hsalida.codnom', '=', 'sno_hperiodo.codnom')
                ->on('sno_hsalida.anocur', '=', 'sno_hperiodo.anocur')
                ->on('sno_hsalida.codperi', '=', 'sno_hperiodo.codperi');
        })
        ->select(
            'sno_hconcepto.codconc',
            'sno_hconcepto.codperi',
            DB::raw("MAX(sno_hconcepto.titcon) as nomcon"),
            DB::raw("SUM(sno_hsalida.valsal) AS valsal"),
            DB::raw("MAX(sno_hsalida.tipsal) AS tipsal"),
            DB::raw("0 AS acuemp"),
            DB::raw("0 AS acupat"),
            DB::raw("MAX(sno_hconcepto.repacucon) as repacucon"),
            DB::raw("MAX(sno_hconcepto.repconsunicon) AS repconsunicon"),
            DB::raw("MAX(sno_hconcepto.consunicon) AS consunicon"),
            DB::raw("MAX(sno_hconcepto.persalnor) AS persalnor"),
            DB::raw("SUM(sno_hsalida.monacusal) AS monacusal"),
            DB::raw("(SELECT SUM(moncon) FROM sno_hconstantepersonal WHERE sno_hconcepto.repconsunicon='1' AND sno_hconstantepersonal.codper = '$codper' AND sno_hconstantepersonal.codemp = sno_hconcepto.codemp AND sno_hconstantepersonal.codnom = sno_hconcepto.codnom AND sno_hconstantepersonal.anocur = sno_hconcepto.anocur AND sno_hconstantepersonal.codperi = sno_hconcepto.codperi AND sno_hconstantepersonal.codcons = sno_hconcepto.consunicon ) AS unidad"),
        )
        ->groupBy([
            'sno_hconcepto.codemp',
            'sno_hconcepto.codnom',
            'sno_hconcepto.codconc',
            'sno_hsalida.tipsal',
            'sno_hconcepto.anocur',
            'sno_hconcepto.codperi',
            'sno_hconcepto.consunicon',
            'sno_hconcepto.repconsunicon',
        ])
        ->union($denominacion_union)
        ->get();

        $asignaciones = [];
        $deducciones = [];

        foreach($denominaciones as $denominacion)
        {
            if($denominacion->codperi != null)
            {
                if(trim($denominacion->tipsal) == 'A'){
                    array_push($asignaciones, $denominacion);
                }else if(trim($denominacion->tipsal) == 'P1')
                {
                    array_push($deducciones, $denominacion);
                }
            }
        }

        if($personal == null)
        {
            return null;
        }

        return [
            'personal' => $personal,
            'asignaciones' => $asignaciones,
            'deducciones' => $deducciones,
            'periodo' => $periodoCustm,
        ];
    }

    /**
     * The function `detect_status_personal` checks the status of a personal record based on a given
     * code and returns whether it is active or not.
     * 
     * @return The function `detect_status_personal` is checking the status of a personal record with
     * the code number '0030165406' in the 'sno_personalnomina' table. If the status (staper) is 1, it
     * returns 'Esta activo' (meaning it is active), otherwise it returns 'no esta activo' (meaning it
     * is not active).
     */
    public function detect_status_personal($codper){
        $status = DB::connection('pgsql')->table('sno_personalnomina')
        ->select('staper')
        ->where('codper', $codper)->first();
        
        return $status;
    }
}
