@extends('template.admin_template')
@section('content')
<div class="container-fluid ">
    
    <div class="card h-100">
        <h5 class="card-header">Registro Acta Matrimonio</h5>
        <div class="card-body">
                <div>

                <form action="{{ route('acta_matrimonio.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="card p-3 h-100">

                                <div class="acta">
                                    <h2>Datos de Acta</h2>
                                
                                    <div class="row">
                                        <div class="mb-3 col">
                                        <label for="acta" class="form-label">Acta</label>
                                        <input type="text" class="form-control" id="acta" name="acta">
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="libro" class="form-label">libro</label>
                                        <input type="text" class="form-control" id="libro" name="libro">
                                        </div>
                                    </div>
                                    <div class="row">
        
                                        <div class="mb-3 col">
                                        <label for="fecha_registro" class="form-label">fecha_registro</label>
                                        <input type="date" class="form-control" id="fecha_registro" name="fecha_registro">
                                        </div>
                                        <div class="form-check col text-center mt-5">
                                            <input type="checkbox" class="form-check-input" id="rectificado" name="rectificado" value="1">
                                            <label class="form-check-label" for="rectificado">Rectificado</label>
                                        </div>
                                    </div>                                                                  
                                    
                                </div>
                                <div class="datos_novio">
                                    <h2>
                                        Datos del Novio
                                    </h2>
                                    <div class="row">
                                        <div class="mb-3 col">
                                        <label for="dni" class="form-label">DNI</label>
                                        <input type="text" class="form-control" id="dni_novio" name="dni_novio">
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="nombres" class="form-label">Nombres</label>
                                        <input type="text" class="form-control" id="nombres_novio" name="nombres_novio">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col">
                                        <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="apellido_paterno_novio" name="apellido_paterno_novio">
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="apellido_materno" class="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" id="apellido_materno_novio" name="apellido_materno_novio">
                                        </div>
                                    </div>
        
                                    
                                </div>
                                <div class="datos_novia">
                                    <h2>
                                        Datos de la Novia
                                    </h2>
                                    <div class="row">
                                        <div class="mb-3 col">
                                        <label for="dni" class="form-label">DNI</label>
                                        <input type="text" class="form-control" id="dni_novia" name="dni_novia">
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="nombres" class="form-label">Nombres</label>
                                        <input type="text" class="form-control" id="nombres_novia" name="nombres_novia">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col">
                                        <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="apellido_paterno_novia" name="apellido_paterno_novia">
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="apellido_materno" class="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" id="apellido_materno_novia" name="apellido_materno_novia">
                                        </div>
                                    </div>
        
                                    
                                </div>
                                <div class="row">
        
                                    <div class="mb-3 col">
                                    <label for="fecha_registro" class="form-label">Fecha de Matrimonio</label>
                                    <input type="date" class="form-control" id="fecha_matrimonio" name="fecha_matrimonio">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col">
                            <div class="card p-3 h-100">
                                <label for="archivo" class="form-label my-2" >Subir Archivo</label>
                                <input type="file" class="form-control" id="archivo" name="archivo" onchange="previewFile()" accept=".pdf">

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