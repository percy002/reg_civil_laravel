@extends('template.admin_template')
@section('content')
<div class="container-fluid ">
    
    <div class="card h-100">
        <h5 class="card-header">Registro de Usuarios</h5>
        <div class="card-body">
                <div>
                <form action="{{ route('usuarios.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="card p-3 h-100">
                                
                                <div class="">
                                    <h2>
                                        Datos Usuario
                                    </h2>
                                    <div class="row">
                                        <div class="mb-3 col">
                                        <label for="dni" class="form-label">DNI</label>
                                        <input type="text" class="form-control" id="dni" name="dni">
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="nombres" class="form-label">Nombres</label>
                                        <input type="text" class="form-control" id="nombres" name="nombres">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col">
                                        <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno">
                                        </div>
                                        <div class="mb-3 col">
                                        <label for="apellido_materno" class="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" id="apellido_materno" name="apellido_materno">
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="mb-3 col">
                                            <label for="rol" class="form-label d-block">Rol</label>
                                            <select class="form-select" name="rol" id="rol">
                                                <option value="usuario" selected>usuario</option>
                                                <option value="administrador">Administrador</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col">
                                            <label for="password" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                            </div>
                                    </div>
        
                                    
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