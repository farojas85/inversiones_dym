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
        Schema::create('clientes', function (Blueprint $table) {
            //'activo','inactivo','suspendido','eliminado']
            $table->increments('id');
            $table->char('dni',8);
            $table->char('ruc',11)->nullable();
            $table->string('nombres',150);
            $table->string('apellidos',150);
            $table->string('razon_social')->nullable();
            $table->string('telefono_fijo',50)->nullable();
            $table->string('celular',15)->nullable();
            $table->string('correo',150)->nullable();
            $table->string('direccion',150)->nullable();
            $table->string('estado');
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
