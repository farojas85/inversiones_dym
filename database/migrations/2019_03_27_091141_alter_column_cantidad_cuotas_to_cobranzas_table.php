<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumnCantidadCuotasToCobranzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cobranzas', function (Blueprint $table) {
            $table->decimal('cantidad_cuotas',8,2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cobranzas', function (Blueprint $table) {
            $table->integer('cantidad_cuotas')->change();
        });
    }
}
