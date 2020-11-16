
@extends('layouts.app');
@section('content');


<div class="container">

    @if (Session::has('Mensaje'))
        <div class="alert alert-success my-4" role="alert">
            {{ Session::get('Mensaje') }}
        </div>
    @endif
    <a class="btn btn-success" href="{{url('empleados/create')}}">Agregar Empleado</a>


    <div class="table table-responsive">
        <table class="table table-light table-hover my-4">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto}}" alt="" width="100"> 
                        </td>
                        <td>{{$empleado->Nombre}} {{$empleado->ApellidoMaterno}} {{$empleado->ApellidoPaterno}}</td>
                        <td>{{$empleado->Correo}}</td>
                        <td>
                            <a  class="btn btn-primary" href="{{url('/empleados/'.$empleado->id.'/edit')}}">Editar</a>
                            <form action="{{url('/empleados/'.$empleado->id) }}" method="post" class="acciones" style="display:inline">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('seguro que quieres borrar este registro?');">Borrar</button>
                            </form>

                        </td>
                    </tr>    
                @endforeach

            </tbody>
        </table>
        {{$empleados->links()}}
    </div>
</div>



@endsection