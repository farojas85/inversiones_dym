<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unique();
            $table->char('dni',8);
            $table->string('nombres',150);
            $table->string('apellidos',150);
            $table->string('telefono_fijo',50)->nullable();
            $table->string('celular',15)->nullable();
            $table->string('licencia',150)->nullable();
            $table->string('direccion',150)->nullable();
            $table->string('estado');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('personals');
    }
}
