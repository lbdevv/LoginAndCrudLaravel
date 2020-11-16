
<div class="form-group col-md-6">
    @if ($Modo=='crear')
        <h3>Agregar Empleado</h3>   
    @else
        <h3>Editar Empleado</h3>
    @endif
</div>

<div class="form-group col-md-6">
    <label class="control-label" for="Nombre">{{'Nombre'}}</label>
    <input class="form-control form-control-sm {{$errors->has('Nombre') ? 'is-invalid':''}}" type="text" name="Nombre" id="Nombre" value="{{ isset($employee->Nombre)?$employee->Nombre: old('Nombre') }}">
    
        {!! $errors->first('Nombre','<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group col-md-6">
    <label class="control-label" for="ApellidoPaterno">{{'Apellido Paterno'}}</label>
    <input class="form-control form-control-sm {{$errors->has('ApellidoPaterno') ? 'is-invalid':''}}" type="text" name="ApellidoPaterno" id="ApellidoPaterno" value="{{isset($employee->ApellidoPaterno)?$employee->ApellidoPaterno: old('ApellidoPaterno')}}">
    {!! $errors->first('ApellidoPaterno','<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group col-md-6">

    <label class="control-label" for="ApellidoMaterno">{{'Apellido Materno'}}</label>
    <input class="form-control form-control-sm {{$errors->has('ApellidoMaterno') ? 'is-invalid':''}}" type="text" name="ApellidoMaterno" id="ApellidoMaterno" value="{{isset($employee->ApellidoMaterno)?$employee->ApellidoMaterno: old('ApellidoMaterno')}}">
    {!! $errors->first('ApellidoMaterno','<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group col-md-6">
    <label class="control-label" for="Correo">{{'Correo'}}</label>
    <input class="form-control form-control-sm {{$errors->has('Correo') ? 'is-invalid':''}}" type="email" name="Correo" id="Correo" value="{{isset($employee->Correo)?$employee->Correo: old('Correo')}}">
    {!! $errors->first('Correo','<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group col-md-6">
    <label class="control-label" for="Foto">{{'Foto'}}</label>
    @if (isset($employee->Foto))
        <br/>
        <img  class="img-thumbnail img-fluid is-invalid" src="{{ asset('storage').'/'.$employee->Foto}}" alt="" width="180"> 
    
        <br/>
    @endif
    <input class="form-control form-control-sm {{$errors->has('Foto') ? 'is-invalid':''}}" type="file" name="Foto" id="Foto" value="">
    {!! $errors->first('Foto','<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group col-md-6">
    <input class="btn btn-success" type="submit" value="{{ $Modo=='crear' ? 'Agregar':'Guardar Cambios' }}">
    <a class="btn btn-primary" href="{{url('empleados')}}">Regresar</a>
</div>







