@extends('template.admin_template')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection
 @section('content')
<div class="container-fluid">
    <div class="card p-3">
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
                    <th>Fecha de Fallecimiento</th>
                    <th>Rectificado</th>
                    <th>Archivo</th>
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
                        <td>{{$acta_nacimiento->archivo}}</td>
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
