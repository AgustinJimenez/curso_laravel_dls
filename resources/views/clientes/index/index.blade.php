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

<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label>Filtro Razon Social:</label>
            <input type="text" class="form-control" placeholder="Razon Social" id="filtro-razon-social">  
        </div>
    </div>
    <div class="col-md-2">
            <div class="form-group">
                <label>Filtro Direccion:</label>
                <input type="text" class="form-control" placeholder="Razon Social" id="filtro-direccion">  
            </div>
        </div>
        <div class="row">
        <div class="col-md-2">
            <button class="btn btn-primary" id="boton-mostar-ajax">PROBAR AJAX</button>
        </div>
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
    var INPUT_RAZON_SOCIAL = $("#filtro-razon-social");
    var INPUT_DIRECCION = $("#filtro-direccion");
    
    $("body").on("click", ".boton-eliminar", function(event)
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

    

    var config = 
	{
		datatable:
		{
			order: [[ 0, "desc" ]],
			ajax_source: '{!! route('clientes.index_ajax') !!}',
			send_request: function (request) 
            {
                request.razon_social = INPUT_RAZON_SOCIAL.val();
                request.direccion = INPUT_DIRECCION.val();
                /*
                request.colegio_token = "{{ session()->get('colegio_token') }}",
                request.titulo = INPUT_BUSCAR_POR_TITULO.val(),
                request.fecha_inicio = INPUT_FECHA_INICIO.val(),
                request.fecha_fin = INPUT_FECHA_FIN.val()
                */
            },
            data_source: function ( json ) 
            {
                return json.data;
            },
            initComplete: function()
            {
                //set_icheckbox();
            },
            columns: 
            [
                { data: 'razon_social', name: 'razon_social', orderable: true, searchable: false},
                { data: 'direccion', name: 'direccion', orderable: true, searchable: false},
                { data: 'ruc', name: 'ruc', orderable: true, searchable: false},
                { data: 'activo', name: 'activo', orderable: true, searchable: false},
                { data: 'acciones', name: 'acciones', orderable: false, searchable: false}
            ],
            default_datas_count: 10,
            tool_bar: '<"toolbar">' + "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r>"+
                        "<'row'<'col-xs-12't>>"+
                        "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>"




		}//end datatable
	}



    var table = $('.table').DataTable
	({
      	dom: config.datatable.tool_bar,
        deferRender: true,
        processing: true,
        serverSide: true,
        order: config.datatable.order,
        paginate: true,
        lengthChange: true,
        iDisplayLength: config.datatable.default_datas_count,
        filter: true,
        sort: true,
        info: true,
        autoWidth: true,
        initComplete: config.datatable.initComplete,
        //"drawCallback": reordenar_celdas(),
        ajax: 
        {
            url: config.datatable.ajax_source,
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            data: config.datatable.send_request,
            dataSrc: config.datatable.data_source,
        },
        columns: config.datatable.columns,
        language: 
        {
            processing:     "Procesando...",
            search:         "Buscar",
            lengthMenu:     "Mostrar _MENU_ Elementos",
            info:           "Mostrando de _START_ a _END_ registros de un total de _TOTAL_ registros",
            //infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            infoFiltered:   ".",
            infoPostFix:    "",
            loadingRecords: "Cargando Registros...",
            zeroRecords:    "No existen registros disponibles",
            emptyTable:     "No existen registros disponibles"/*,
            paginate: 
            {
                first:      "Primera",
                previous:   "<i class='fa fa-chevron-left'></i>",
                next:       "<i class='fa fa-chevron-right'></i>",
                last:       "Ultima"
            }
            */
        } 
    });


    INPUT_RAZON_SOCIAL.keyup(function()
    {
        table.draw();
    });
    INPUT_DIRECCION.keyup(function()
    {
        table.draw();
    });

    BOTON_PROBAR_AJAX.click(function()
    {
    
        $.ajax
        ({
            url: "{{ route('clientes.prueba_ajax') }}?variable_uno=1&variable_dos=2",
            headers: { codigo_secreto: "gatoo" },
            success: function(respuesta)
            {
                console.log( respuesta );
            }
        });
    
    
    });

</script>
@endsection


