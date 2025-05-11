<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\TipoNegocio;
use App\Models\Vigencia;
use Illuminate\Http\Request;
use App\Services\SeguimientoService;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $negocios =TipoNegocio::all();
        $vigencias = Vigencia::all();
        return view("auth.registerEmpresa",compact("vigencias","negocios"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, SeguimientoService $seguimientoService)
    {
        $request->validate([
            "nombre" => "required|min:3",
            "representante" => "required",
            "correo" => "required|email",
            "rfc" => "required",
            "direccion" => "required",
            "telefono" => ['required', 'regex:/^\(\d{3}\) \d{3}-\d{4}$/'],
            "vigencia" => "required",
            "estatus" => "required",
            "id_tipo_negocio" => "required",
        ], [
            // Mensajes personalizados
            'nombre.required'   => 'El campo nombre de la empresa es obligatorio.',
            'nombre.min'        => 'El nombre debe tener al menos :min caracteres.',
            'representante.required'   => 'El campo Representante de la empresa es obligatorio.',
            'correo.required'    => 'Por favor ingresa un correo electrónico.',
            'correo.email'       => 'El correo no tiene un formato válido como correo@gmail.com.',
            'rfc.required'   => 'El campo RFC de la empresa es obligatorio.',
            'direccion.required'   => 'El campo Dirección de la empresa es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex'    => 'El formato del teléfono debe ser (123) 456-7890.',
            'vigencia.required' => 'Selecciona la vigencia',
            'estatus.required'  => 'Selecciona un estatus.',
            'estatus.in'        => 'El estatus seleccionado no es válido.',
            "id_tipo_negocio.required" => "El campo el tipo de negocio es obligatorio",
        ]);
        try {
            $empresa = new Empresa();
            $empresa->nombre_empresa = strtoupper(trim($request->nombre));
            $empresa->representante_empresa = strtoupper(trim($request->representante));
            $empresa->email_empresa = strtolower(trim($request->correo));
            $empresa->rfc_empresa = strtoupper(trim($request->rfc));
            $empresa->direccion_empresa = strtoupper(trim($request->direccion));
            $empresa->telefono_empresa = strtoupper(trim($request->telefono));
            $empresa->id_vigencia = $request->vigencia;
            $empresa->estatus_empresa = $request->estatus;
            $empresa->id_tipo_negocio = $request->id_tipo_negocio;

            if($empresa->save()){
                $respuesta = $seguimientoService->registrar("Registrar Empresa",$empresa,Auth::id() ?? 1,$empresa->id);
                if(!$respuesta->error){
                    return redirect()->back()->with('success', 'Empresa registrada correctamente.');    
                }else{
                    return redirect()->back()->with('error', 'Ocurrió un error al registrar el seguimiento {$respuesta->error}.');    
                }
            }else{
                return redirect()->back()->with('error', 'Ocurrió un error al registrar la empresa, vuelve a intentarlo.');    
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Ocurrió un error al registrar la empresa, {$th->getMessage()}.');
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
