<?php

use App\Modelos\Cliente;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () 
{

    return view('welcome');
});

Route::get('clientes',
[
    'as' => 'clientes.index',
    'uses' => 'ClientesController@index'
]);

Route::post('clientes/index_ajax',
[
    'as' => 'clientes.index_ajax',
    'uses' => 'ClientesController@index_ajax'
]);

Route::get('clientes/crear',
[
    'as' => 'clientes.create',
    'uses' => 'ClientesController@create'
]);

Route::post('clientes/guardar',
[
    'as' => 'clientes.store',
    'uses' => 'ClientesController@store'
]);

Route::get('clientes/{id}/editar',
[
    'as' => 'clientes.edit',
    'uses' => 'ClientesController@edit'
]);

Route::put('clientes/{id}/actualizar',
[
    'as' => 'clientes.update',
    'uses' => 'ClientesController@update'
]);

Route::delete('clientes/{id}/eliminar',
[
    'as' => 'clientes.destroy',
    'uses' => 'ClientesController@destroy'
]);

Route::get('clientes/prueba_ajax',
[
    'as' => 'clientes.prueba_ajax',
    'uses' => 'ClientesController@prueba_ajax',
    'middleware' => 'verificacion-codigo-secreto'
]);


Route::get('foo', function () 
{
    $a = 'jorge';
    $b = 15;
    $c = 5.5;
    $d = 'ivan';
    //jfajfdoadfadf
    /*
        apofnpadnfp
        aodijfpaf
    */
    $e = ["mesa", "manzana", "telefono"];

    $f = [ "auto" => "chevrolet", "telefono" => "samsung", "pais" => "paraguay" ];

    $persona = 
    [
        "amigos" => ["laura", "jorge", "ivan", "jose"],
        "mascotas" => 
        [
            "perros" => ["manuel", "pepe", "diego"],
            "gatos" => ["michi", "none"]
        ],
        "edad" => 18,
        "dinero" => 1781.147,
        "direccion" => "en algun lugar"
    ];
/*
    foreach($f as $key => $elemento)
    {
        dd( $key, $elemento );        
    }
*/
    $fecha_hoy = date("d/m/Y H:i:s");
    
/*  
    $nc = new Cliente;
    $nc->razon_social = "Carlos Gomez " . date("His");
    $nc->fecha_nacimiento = date("Y-m-d");
    $nc->direccion = "Algun lado";
    $nc->comentario = "algun comentario";
    $nc->ruc = "12348-8";
    $nc->activo = true;

    $nc->save();
    dd( $nc );
*/

    //$clientes = Cliente::get();
    
    /*
    $clientes_query = Cliente::query();

    $clientes_query
    ->where("activo", true)
    ->where("razon_social", "like", "%iv%")
    ->orderBy("razon_social", "DESC")
    ->take(4);

    $clientes = $clientes_query->get();

    dd(
        $clientes_query->toSql(),

        $clientes->toArray()
    );
    */

    return $e;
});
