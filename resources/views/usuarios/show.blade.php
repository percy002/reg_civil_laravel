@extends('template.admin_template')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection
 @section('content')
<div class="container-fluid p-3">
    <h3 class="h3">Lista de Usuarios</h3>
    <div class="card p-3">
        <div class="row mb-3">

            <div class="col-3">

                <a href="{{ route('usuarios.create')}}" type="button" class="btn btn-success">Agregar Nuevo Usuario</a>
            </div>
        </div>
        <table id="T_actas_defunciones" class="table table-striped" style="width:100%" >
            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th>Dni</th>
                    <th>estado</th>
                    <th>Rol</th>
                    <th>Opciones</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{$usuario->nombres}} - {{$usuario->apellido_paterno}} - {{$usuario->apellido_materno}}</td>
                        <td>{{$usuario->dni}}</td>
                        <td>{{$usuario->estado}}</td>
                        <td>{{$usuario->getRoleNames()[0];}}</td>
                        <td>
                            <a href="{{ route('usuarios.edit', $usuario->id)}}" type="button" class="btn btn-warning">Editar</a>
                            
                        </td>
                    </tr>
                @endforeach              
                
            </tbody>
    </div>
</div>
@endsection
@section('scripts')
<script>
    //  $('#T_actas_defunciones').DataTable();
</script>
@endsection
