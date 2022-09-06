@extends('adminlte::page')
@section('title','Registro Civil')
    
@section('css')
{{-- <link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">     --}}
@endsection
{{-- <h1>Registro civil</h1> --}}
@section('content')
@yield('content')
    <p>hola mundo</p>
@endsection


@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>


<script>
    $('#T_actas_defunciones').DataTable();

    
</script>

<script>
    function previewFile() {
    const preview = document.querySelector('iframe');
    const file = document.querySelector('input[type=file]').files[0];
    // console.log(file);

    const reader = new FileReader();
    var filename = file.name;
    reader.addEventListener("load", function () {
      // convert file to base64 string
      preview.src = reader.result;
    }, false);

    if (file) {
      reader.readAsDataURL(file);
    }

  }
</script>

@endsection