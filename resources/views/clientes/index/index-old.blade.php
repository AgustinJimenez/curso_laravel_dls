@extends('templates.template_uno.master')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-confirm.css') }}">
    <style>
        th, td
        {
            text-align: center;
        }
    </style>
@endsection

@section('contenido')
<div class="form-group row">
    <div class="col-md-2 pull-right">
    <a href="{{ route('clientes.create') }}" class="btn btn-success">CREAR CLIENTE</a>
    </div>
</div>

<table class="table table-striped table-bordered table-hover" id="tabla-clientes">
    <thead class="bg-primary">
        <tr>
            <th>RAZON SOCIAL</th>
            <th>DIRECCION</th>
            <th>RUC</th>
            <th>ACTIVO</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>

        @foreach($clientes as $c)
            <tr>
                <td> {{ $c->razon_social }} </td>
                <td> {{ $c->direccion }} </td>
                <td> {{ $c->ruc }} </td>
                <td> {{ $c->activo }} </td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('clientes.edit', [$c->id]) }}" class="btn btn-warning">EDITAR</a>

                        <form action="{{ route('clientes.destroy', [$c->id]) }}" method="POST">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="DELETE">

                            <input type="submit" class="btn btn-danger boton-eliminar" value="ELIMINAR">

                        </form>
                    
                    </div>                         
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot class="bg-primary">
        <tr>
            <th>RAZON SOCIAL</th>
            <th>DIRECCION</th>
            <th>RUC</th>
            <th>ACTIVO</th>
            <th>ACCIONES</th>
        </tr>
    </tfoot>
</table>
@endsection

@section('scripts')
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{ asset('js/jquery-confirm.js') }}"></script>
<script>
    
    $(".boton-eliminar").click( function(event)
    {
        var formulario = $(this).parent("form");
        
        $.confirm
        ({
            title: "Aviso",
            content: 'Seguro que quiere eliminar el registro?',
            buttons: 
            {
                si: 
                {
                    //isHidden: true, // hide the button
                    btnClass: 'btn-red',
                    action: function () 
                    {
                        formulario.submit();
                    }
                },
                cancelar: 
                {
                    btnClass: 'btn-blue',
                    action: function () 
                    {
                        
                    }
                },
            }
        });
        
        event.preventDefault();
        
    } );


</script>
@endsection


