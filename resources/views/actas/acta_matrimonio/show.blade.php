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
                    <th>Novio</th>
                    <th>Novia</th>
                    <th>Acta</th>
                    <th>Libro</th>
                    <th>Fecha de Registro</th>
                    <th>Fecha de matrimonio</th>
                    <th>Rectificado</th>
                    <th>Archivo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($acta_matrimonios as $acta_matrimonio)
                    <tr>
                        <td>{{$acta_matrimonio->novio}}</td>
                        <td>{{$acta_matrimonio->novia}}</td>
                        <td>{{$acta_matrimonio->acta}}</td>
                        <td>{{$acta_matrimonio->libro}}</td>
                        <td>{{$acta_matrimonio->fecha_registro_format}}</td>
                        <td>{{$acta_matrimonio->fecha_matrimonio_format}}</td>
                        <td>{{$acta_matrimonio->rectificado}}</td>
                        <td>{{$acta_matrimonio->archivo}}</td>
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
