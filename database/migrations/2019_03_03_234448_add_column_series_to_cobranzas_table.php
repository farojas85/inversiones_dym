<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSeriesToCobranzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cobranzas', function (Blueprint $table) {
            $table->char('serie',4);
            $table->integer('numero');
            $table->decimal('pagado',18,2);
            $table->decimal('vuelto',18,2);
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
           $table->dropColumn('serie');
           $table->dropColumn('numero');
           $table->dropColumn('pagado');
           $table->dropColumn('vuelto');
        });
    }
}
