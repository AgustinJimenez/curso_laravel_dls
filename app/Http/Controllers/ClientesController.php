<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\ClientesStoreRequest;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("clientes.index.index");
    }

    public function index_ajax(Request $request)
    {

        $clientes_query = \Cliente::query();

        if( $request->has('razon_social') AND $request->razon_social != '' )
            $clientes_query->where('razon_social', 'like', '%' . $request->razon_social . '%' );

        if( $request->has('direccion') AND $request->direccion != '' )
            $clientes_query->where('direccion', 'like', '%' . $request->direccion . '%' );
        
        if( $request->has('activo') AND $request->activo != '' )
            $clientes_query->where("activo", $request->activo);
/*
        if( $request->fecha_fin and $request->has('fecha_fin') and $request->get('fecha_fin') != '' )
            $query->where('fecha', '<=', \Carbon::createFromFormat( 'd/m/Y', $request->get('fecha_fin') )->format('Y-m-d') );

        if( $request->has('titulo') and $request->get('titulo') != ''  )
            $query->where('titulo', 'like', '%' . $request['titulo'] . '%' );
*/
        $object = Datatables::of( $clientes_query )
        ->addColumn('acciones', function ($row)
        {
            return '
                    <div class="btn-group">
                    <a href="' . route('clientes.edit', [$row->id]) . '" class="btn btn-warning">EDITAR</a>

                    <form action="' . route('clientes.destroy', [$row->id]) . '" method="POST">
                        ' . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">

                        <input type="submit" class="btn btn-danger boton-eliminar" value="ELIMINAR">

                    </form>
                
                </div>  
                    ';
        })
        ->editColumn("activo", function($row)
        {
            return $row->activo ? 'SI' : 'NO' ;
        })
        ->editColumn("ruc", function($registro)
        {
                                //valor - cantidad decimales - separador decimal -separador mil
            return number_format( $registro->ruc,0 ,'', '' );
        })
        ->setRowClass( function ($tabla) 
        { 
            return "text-center"; 
        })
        ->rawColumns(['acciones'])
        ->make(true);
        $data = $object->getData(true);
        return response()->json( $data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cliente = new \Cliente;

        return view("clientes.create", compact("cliente"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientesStoreRequest $request)
    {   

        \Cliente::create( $request->all() );

        return redirect()->route("clientes.index")->withSuccess( "El cliente se creo correctamente." );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = \Cliente::find($id);
        
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = \Cliente::find( $id );

        $cliente->update( $request->all() );

        return redirect()->route("clientes.index")->withSuccess( "El cliente se creo correctamente." );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Cliente::find( $id )->delete();

        return redirect()->route("clientes.index");
    }


    public function prueba_ajax(Request $re)
    {

        return response()->json( ['HOLA AQUI CONTROLADOR'] );
    }

}
