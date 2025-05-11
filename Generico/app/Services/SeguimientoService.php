<?php

namespace App\Services;

use App\Models\Seguimiento;

class SeguimientoService
{
    public function registrar($accion, $datos,$usuario,$empresa)
    {
        try {
            return Seguimiento::create([
                'accion' => $accion,
                'fecha' => now(),
                'datos' => $datos,
                'id_usuario' => $usuario,
                'id_empresa'=>$empresa,
            ]);
        } catch (\Throwable $th) {
            $error = ['error' => $th->getMessage()];
            return $error;
        }
    }
}