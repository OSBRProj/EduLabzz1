<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToGamificacaoUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gamificacao_usuario', function (Blueprint $table) {

            $table->boolean('notificado_level_up')->nullable();

        });
    }




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gamificacao_usuario', function (Blueprint $table) {

            $table->dropColumn('notificado_level_up');

        });
    }
}


