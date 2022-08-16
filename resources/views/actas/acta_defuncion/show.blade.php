@extends('template.admin_template')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection
 @section('content')
<div class="container-fluid p-3">
    <h3 class="h3">Actas de Defuncion</h3>
    <div class="card p-3">
        <div class="row mb-3">

            <div class="col-3">

                <a href="{{ route('acta_defuncion.create')}}" type="button" class="btn btn-success">Agregar Acta de Defuncion</a>
            </div>
        </div>
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
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($acta_defunciones as $acta_defuncion)
                    <tr>
                        <td>{{$acta_defuncion->fallecido}}</td>
                        <td>{{$acta_defuncion->sexo}}</td>
                        <td>{{$acta_defuncion->acta}}</td>
                        <td>{{$acta_defuncion->libro}}</td>
                        <td>{{$acta_defuncion->fecha_registro_format}}</td>
                        <td>{{$acta_defuncion->fecha_fallecimiento_format}}</td>
                        <td>{{$acta_defuncion->rectificado}}</td>
                        <td>{{$acta_defuncion->archivo}}
                            <button type="button" class="btn btn-primary">Ver pdf</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#acta{{$acta_defuncion->id}}">
                                Ver pdf
                              </button>
                              
                              <!-- Modal -->
                              <div class="modal fade" id="acta{{$acta_defuncion->id}}" tabindex="-1" role="dialog" aria-labelledby="ver_actaTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      {{-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> --}}
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <iframe id="iframe-pdf" width="100%" style="height: 600px" class="pdf_acta p-2" src="{{asset($acta_defuncion->archivo) }}"  frameborder="0"></iframe>

                                    </div>
                                    
                                  </div>
                                </div>
                              </div>
                        </td>
                        <td>
                            <a href="{{ route('acta_defuncion.edit', $acta_defuncion->id)}}" type="button" class="btn btn-warning">Editar</a>
                            
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
