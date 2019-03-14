<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterForeignToClientePersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cliente_personal', function (Blueprint $table) {
            //Eliminamos las claves foráneas
            $table->dropForeign('cliente_personal_cliente_id_foreign');
            $table->dropForeign('cliente_personal_personal_id_foreign');
            //Añadimos las claves foráneas con eliminación en casda
            $table->foreign('cliente_id')->references('id')->on('clientes')
                    ->onDelete('cascade')
                    ->change();
            
            $table->foreign('personal_id')->references('id')->on('personals')
                    ->onDelete('cascade')
                    ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cliente_personal', function (Blueprint $table) {
            $table->dropForeign('cliente_personal_cliente_id_foreign');
            $table->dropForeign('cliente_personal_personal_id_foreign');
            //Añadimos las claves foráneas con eliminación en casda
            $table->foreign('cliente_id')->references('id')->on('clientes')
                    ->change();
            
            $table->foreign('personal_id')->references('id')->on('personals')
                    ->change();
        });
    }
}
