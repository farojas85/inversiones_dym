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
            $table->increments('id');
            $table->unsignedInteger('cliente_id');
            $table->dateTime('fecha_prestamo');
            $table->decimal('monto',18,2);
            $table->enum('tasa_interes',[0.15,0.20,0.25]);
            $table->dateTime('fecha_vencimiento');
            $table->enum('estado',['Pendiente','Cancelado','Anulado','Eliminado']);
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
