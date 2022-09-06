@extends('template.admin_template')
@section('content')
<div class="container-fluid ">
    
    <div class="card h-100">
        <h5 class="card-header">Registro Acta Defuncion</h5>
        <div class="card-body">
                <div>
                <form method="post" action="{{ route('acta_defuncion.update', $acta_defuncion->id ) }}" enctype="multipart/form-data"> 
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col">
                            <div class="card p-3 h-100">

                                <div class="acta">
                                    <h2>Datos de Acta</h2>
                                
                                    <div class="row">
                                        <div class="mb-3 col">
                                        <label for="acta" class="form-label">Acta</label>
                                        <input type="text" class="form-control" id="acta" name="acta" value="{{$acta_defuncion->acta}}">
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="libro" class="form-label">libro</label>
                                        <input type="text" class="form-control" id="libro" name="libro" value="{{$acta_defuncion->libro}}">
                                        </div>
                                    </div>
                                    <div class="row">
        
                                        <div class="mb-3 col">
                                        <label for="fecha_registro" class="form-label">fecha_registro</label>
                                        <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" value="{{$acta_defuncion->fecha_registro}}">
                                        </div>
                                        <div class="form-check col text-center mt-5">
                                            <input type="checkbox" class="form-check-input" id="rectificado" name="rectificado" value="1" {{ $acta_defuncion->rectificado == 1 ? 'checked' : null }}>
                                            <label class="form-check-label" for="rectificado">Rectificado</label>
                                        </div>
                                    </div>
                                
                                    
                                    
                                </div>
                                <div class="datos_fallecido">
                                    <h2>
                                        Datos Fallecido
                                    </h2>
                                    <div class="row">
                                        <div class="mb-3 col">
                                        <label for="dni" class="form-label">DNI</label>
                                        <input type="text" class="form-control" id="dni" name="dni" value="{{$acta_defuncion->persona->dni}}">
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="nombres" class="form-label">Nombres</label>
                                        <input type="text" class="form-control" id="nombres" name="nombres" value="{{$acta_defuncion->persona->nombres}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col">
                                        <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" value="{{$acta_defuncion->persona->apellido_paterno}}">
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="apellido_materno" class="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" value="{{$acta_defuncion->persona->apellido_materno}}">
                                        </div>
                                    </div>
        
                                    <div class="row">
                                        <div class="mb-3 col">
                                            <label for="sexo" class="form-label d-block">Sexo</label>
                                            <select class="form-select" name="sexo" id="sexo">
                                                <option value="masculino" {{ $acta_defuncion->persona->sexo == 'masculino' ? 'selected' : null }}>Masculino</option>
                                                <option value="femenino" {{ $acta_defuncion->persona->sexo == 'femenino' ? 'selected' : null }} selec>Femenino</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="fecha_nacimiento" class="form-label">Fecha de Defuncion</label>
                                        <input type="date" class="form-control" id="fecha_defuncion" name="fecha_defuncion" value="{{$acta_defuncion->fecha_defuncion}}">
                                        </div>
                                    </div>

                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                            </div>

                        </div>
                        <div class="col">
                            <div class="card p-3 h-100">
                                <input type="text " hidden value="{{$acta_defuncion->archivo}}" name="old_archivo">
                                <input type="text " hidden value="{{$acta_defuncion->persona->id}}" name="id_persona">
                                <label for="archivo" class="form-label my-2" >Subir Archivo</label>
                                <input type="file" class="form-control" id="archivo" onchange="previewFile()" accept=".pdf" name="archivo" value="{{$acta_defuncion->archivo}}">
                                <div class="card-body">

                                    <iframe id="iframe-pdf" width="100%" style="height: 600px" class="pdf_acta p-2" src="{{asset($acta_defuncion->archivo) }}"  frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
                </div>
            </div>
                
    </div>
        
    
    
</div>
    
@endsection