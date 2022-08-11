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
                    <th>Fecha de Registro</th>
                    <th>Fecha de Fallecimiento</th>
                    <th>Rectificado</th>
                    <th>Archivo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($acta_defunciones as $acta_defuncion)
                    <tr>
                        <td>{{$acta_defuncion->fallecido}}</td>
                        <td>{{$acta_defuncion->sexo}}</td>
                        <td>{{$acta_defuncion->acta}}</td>
                        <td>{{$acta_defuncion->libro}}</td>
                        <td>{{$acta_defuncion->fecha_registro}}</td>
                        <td>{{$acta_defuncion->fecha_defuncion}}</td>
                        <td>{{$acta_defuncion->rectificado}}</td>
                        <td>{{$acta_defuncion->archivo}}</td>
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
