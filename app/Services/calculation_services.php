<?php

namespace App\Services;

class calculation_services{
    public function totalAsignaciones($data){
         
         $totalAsignaciones = 0;
         foreach($data->asignaciones as $asignacion){
             $totalAsignaciones += $asignacion->valsal;
         }
         return $totalAsignaciones;

     }
     public function saludo (){
        dd('Hola');
     }

     public function totalDeducciones($data){
        $totalDeducciones = 0;
        foreach($data->deducciones as $deduccion){
            $totalDeducciones += $deduccion->valsal;
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