<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalMontosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_montos', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('monto_asignado',18,2);
            $table->decimal('monto_saldo',18,2);
            $table->integer('consumido');
            $table->unsignedInteger('personal_id');
            $table->integer('asignado_por');
            $table->dateTime('fecha');
            $table->integer('orden');
            $table->foreign('personal_id')->references('id')->on('personals');
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
        Schema::dropIfExists('personal_montos');
    }
}
