@extends('template.admin_template')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection
 @section('content')
<div class="container-fluid p-3">
    <h3 class="h3">Actas de Nacimientos</h3>
    <div class="card p-3">
        <div class="row mb-3">

            @can('editor')
            <div class="col-3">

                <a href="{{ route('acta_nacimiento.create')}}" type="button" class="btn btn-success">Agregar Acta de Nacimiento</a>
            </div>
            @endcan
        </div>
        <table id="T_actas_defunciones" class="table table-striped" style="width:100%" >
            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th>Sexo</th>
                    <th>Acta</th>
                    <th>Libro</th>
                    <th>Padre</th>
                    <th>Madre</th>
                    <th>Fecha de Registro</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Rectificado</th>
                    <th>Archivo</th>
                    @can('editor')
                    <th>Opciones</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($acta_nacimientos as $acta_nacimiento)
                    <tr>
                        <td>{{$acta_nacimiento->nacido}}</td>
                        <td>{{$acta_nacimiento->sexo}}</td>
                        <td>{{$acta_nacimiento->acta}}</td>
                        <td>{{$acta_nacimiento->libro}}</td>
                        <td>{{$acta_nacimiento->padre}}</td>
                        <td>{{$acta_nacimiento->madre}}</td>
                        <td>{{$acta_nacimiento->fecha_registro_format}}</td>
                        <td>{{$acta_nacimiento->fecha_nacimiento_format}}</td>
                        <td>{{$acta_nacimiento->rectificado}}</td>
                        <td>{{$acta_nacimiento->archivo}}
                            <button type="button" class="btn btn-primary">Ver pdf</button>
                        </td>
                        @can('editor')
                        <td>
                            <a href="{{ route('acta_nacimiento.edit', $acta_nacimiento->id)}}" type="button" class="btn btn-warning">Editar</a>
                            
                        </td>
                        @endcan
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
