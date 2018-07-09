@extends('templates.template_uno.master')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">
@endsection

@section('contenido')

<form action="{{ route("clientes.update", [$cliente->id]) }}" method="POST">

        <input type="hidden" name="_method" value="PUT">
        
        @include("clientes.partials.formulario")

        <div class="row">
            <input type="submit" class="btn btn-primary" value="ACTUALIZAR">
        </div>

</form>
@endsection

@section('scripts')
<script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/es.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.es.js') }}"></script>
    <script>
        
        $('#fecha_nacimiento').datetimepicker(
        {
            format: 'DD/MM/YYYY',
            ignoreReadonly: true
        });
        
    </script>
@endsection
