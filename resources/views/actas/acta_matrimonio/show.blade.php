@extends('template.admin_template')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection
 @section('content')
<div class="container-fluid p-3" >
    <h3 class="h3">Actas de Matrimonios</h3>
    <div class="card p-3">
        <div class="row mb-3">
            @can('editor')
            <div class="col-3">

                <a href="{{ route('acta_matrimonio.create')}}" type="button" class="btn btn-success">Agregar Acta de Matrimonio</a>
            </div>
            @endcan
        </div>
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
                    @can('editor')
                    <th>Opciones</th>
                    @endcan
                    
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
                        <td>{{$acta_matrimonio->rectificado == 1 ? "Si":"No"}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#acta{{$acta_matrimonio->id}}">
                                Ver pdf
                              </button>
                              
                              <!-- Modal -->
                              <div class="modal fade" id="acta{{$acta_matrimonio->id}}" tabindex="-1" role="dialog" aria-labelledby="ver_actaTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      {{-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> --}}
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <iframe id="iframe-pdf" width="100%" style="height: 600px" class="pdf_acta p-2" src="{{asset($acta_matrimonio->archivo) }}"  frameborder="0"></iframe>

                                    </div>
                                    
                                  </div>
                                </div>
                              </div>
                        </td>
                        @can('editor')
                        <td>
                            <a href="{{ route('acta_matrimonio.edit', $acta_matrimonio->id)}}" type="button" class="btn btn-warning">Editar</a>
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
