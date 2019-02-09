<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalAdelantosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_adelantos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('personal_id');
            $table->string('motivo');
            $table->dateTime('fecha');
            $table->decimal('monto',18,2);
            $table->char('mes_adelanto',2);
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
        Schema::dropIfExists('personal_adelantos');
    }
}
