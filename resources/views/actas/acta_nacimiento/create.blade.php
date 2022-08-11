@extends('template.admin_template')
@section('content')
<div class="container-fluid ">
    
    <div class="card h-100">
        <h5 class="card-header">Registro Acta Nacimiento</h5>
        <div class="card-body">
                <div>

                <form>
                    <div class="row">
                        <div class="col">
                            <div class="card p-3 h-100">

                                <div class="acta">
                                    <h2>Datos de Acta</h2>
                                
                                    <div class="row">
                                        <div class="mb-3 col">
                                        <label for="acta" class="form-label">Acta</label>
                                        <input type="text" class="form-control" id="acta">
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="libro" class="form-label">libro</label>
                                        <input type="text" class="form-control" id="libro">
                                        </div>
                                    </div>
                                    <div class="row">
        
                                        <div class="mb-3 col">
                                        <label for="fecha_registro" class="form-label">fecha_registro</label>
                                        <input type="date" class="form-control" id="fecha_registro">
                                        </div>
                                        <div class="form-check col text-center mt-5">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Rectificado</label>
                                        </div>
                                    </div>
                                
                                    
                                    
                                </div>
                                <div class="datos_padre">
                                    <h2>
                                        Datos del Padre
                                    </h2>
                                    <div class="row">
                                        <div class="mb-3 col">
                                        <label for="dni" class="form-label">DNI</label>
                                        <input type="text" class="form-control" id="dni_padre" name="dni">
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="nombres" class="form-label">Nombres</label>
                                        <input type="text" class="form-control" id="nombres_padre">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col">
                                        <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="apellido_paterno_padre" name="apellido_paterno">
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="apellido_materno" class="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" id="apellido_materno_padre" name="apellido_materno">
                                        </div>
                                    </div>
        
                                    
                                </div>
                                <div class="datos_madre">
                                    <h2>
                                        Datos de la Madre
                                    </h2>
                                    <div class="row">
                                        <div class="mb-3 col">
                                        <label for="dni" class="form-label">DNI</label>
                                        <input type="text" class="form-control" id="dni_madre" name="dni">
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="nombres" class="form-label">Nombres</label>
                                        <input type="text" class="form-control" id="nombres_madre">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col">
                                        <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="apellido_paterno_madre" name="apellido_paterno">
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="apellido_materno" class="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" id="apellido_materno_madre" name="apellido_materno">
                                        </div>
                                    </div>
        
                                    
                                </div>

                                <div class="datos_nacido">
                                    <h2>
                                        Datos del Nacido
                                    </h2>
                                    <div class="row">
                                        <div class="mb-3 col">
                                        <label for="dni" class="form-label">DNI</label>
                                        <input type="text" class="form-control" id="dni_nacido" name="dni">
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="nombres" class="form-label">Nombres</label>
                                        <input type="text" class="form-control" id="nombres_nacido">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col">
                                        <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="apellido_paterno_nacido" name="apellido_paterno">
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="apellido_materno" class="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" id="apellido_materno_nacido" name="apellido_materno">
                                        </div>
                                    </div>
        
                                    <div class="row">
                                        <div class="mb-3 col">
                                            <label for="sexo" class="form-label d-block">Sexo</label>
                                            <select class="form-select" name="sexo" id="sexo">
                                                <option value="1" selected>Masculino</option>
                                                <option value="2">Femenino</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                                        </div>
                                    </div>
                                </div>                               

                                
                            </div>

                        </div>
                        <div class="col">
                            <div class="card p-3 h-100">
                                <label for="archivo" class="form-label my-2" >Subir Archivo</label>
                                <input type="file" class="form-control" id="archivo" onchange="previewFile()" accept=".pdf">

                                <iframe id="iframe-pdf" style="height: 100%" class="pdf_acta p-2" src="http://jornadasciberseguridad.riasc.unileon.es/archivos/ejemplo_esp.pdf"  frameborder="0"></iframe>
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