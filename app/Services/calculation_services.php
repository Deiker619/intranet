<?php

namespace App\Services;

class calculation_services{
    public function totalAsignaciones($data){
         $totalAsignaciones = 0;
         if (!is_object($data)) {
             return $totalAsignaciones;
         }
         foreach ($data->asignaciones ?? [] as $asignacion) {
             $totalAsignaciones += $asignacion->valsal ?? 0;
         }
         return $totalAsignaciones;

     }
     public function saludo (){
        dd('Hola');
     }

     public function totalDeducciones($data){
        $totalDeducciones = 0;
        if (!is_object($data)) {
            return $totalDeducciones;
        }
        foreach ($data->deducciones ?? [] as $deduccion) {
            $totalDeducciones += $deduccion->valsal ?? 0;
        }
        return $totalDeducciones;
    }
    public function calculateTotales($data){
        $total_asign_q1 = $this->totalAsignaciones($data['primera-quincena']);
        $total_deduc_q1 = $this->totalDeducciones($data['primera-quincena']);
        if ($data['segunda-quincena']) {
            $total_asign_q2 = $this->totalAsignaciones($data['segunda-quincena']);
            $total_deduc_q2 = $this->totalDeducciones($data['segunda-quincena']);
            $total_asignaciones = $total_asign_q1 + $total_asign_q2;
            $total_deducciones = $total_deduc_q1 + $total_deduc_q2;
            $data['total_asignaciones'] = $total_asignaciones;
            $data['total_deducciones'] = $total_deducciones;
            return $data;
        }else{
            $data['total_asignaciones'] = $total_asign_q1;
            $data['total_deducciones'] = $total_deduc_q1;
            return $data;
        }
    }
}
