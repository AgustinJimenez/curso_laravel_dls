<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) 
        {
            
            $table->increments('id');

            $table->string("razon_social", 60)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string("direccion", 90)->nullable();
            $table->string("ruc", 15)->nullable();

            $table->string("comentario")->default("Sin comentario para el cliente");

            $table->boolean('activo')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
