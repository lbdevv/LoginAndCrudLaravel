<?php

namespace App\Http\Controllers;

use App\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['empleados'] = Empleados::paginate(3);
        return view('empleados.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields=[
            'Nombre' => 'required|string|max:100',
            'ApellidoPaterno' => 'required|string|max:100',
            'ApellidoMaterno' => 'required|string|max:100',
            'Correo' => 'required|email',
            'Foto' => 'required|max:10000|mimes:jpeg,png,jpg'
        ];

        $message=["required" => 'El :attribute es requerido'];
        $this->validate($request,$fields,$message);
        
        $dataEmployee = request()->except('_token');

        if($request->hasFile('Foto')){
            $dataEmployee['Foto'] = $request->file('Foto')->store('uploads','public');
        }

        Empleados::insert($dataEmployee);

        return redirect('empleados')->with('Mensaje','Empleado agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function show(Empleados $empleados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Para buscar el empleado
        $employee = Empleados::findOrFail($id);

        return view('empleados.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fields=[
            'Nombre' => 'required|string|max:100',
            'ApellidoPaterno' => 'required|string|max:100',
            'ApellidoMaterno' => 'required|string|max:100',
            'Correo' => 'required|email'
        ];
        
        if($request->hasFile('Foto')){
            $fields +=['Foto' => 'required|max:10000|mimes:jpeg,png,jpg'];
        }

        $message=["required"=>'El :attribute es requerido'];
        $this->validate($request,$fields,$message);

        $dataEmployee = request()->except(['_token','_method']);


        if($request->hasFile('Foto')){
            $employee = Empleados::findOrFail($id);

            Storage::delete('public/'.$employee->Foto);

            $dataEmployee['Foto'] = $request->file('Foto')->store('uploads','public');
        }

        Empleados::where('id','=', $id)->update($dataEmployee);

        // $employee = Empleados::findOrFail($id);
        // return view('empleados.edit', compact('employee'));

        return redirect('empleados')->with('Mensaje','Cambios guardados con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $employee = Empleados::findOrFail($id);
        if(Storage::delete('public/'.$employee->Foto)){
            Empleados::destroy($id);
        }
    
        return redirect('empleados')->with('Mensaje','Registro Eliminado con éxito.');
    }
}
