<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            //,['Generado','Pendiente','Cancelado','Anulado','Eliminado']
            $table->increments('id');
            $table->unsignedInteger('cliente_id');
            $table->dateTime('fecha_prestamo');
            $table->decimal('monto',18,2);
            $table->decimal('tasa_interes',10,2);
            $table->dateTime('fecha_vencimiento');
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
        Schema::dropIfExists('prestamos');
    }
}
