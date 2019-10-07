<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfiguracoesNotificacoesUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracoes_notificacoes_user', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');

            $table->boolean('rcb_notif_resp_professor')->default(1);
            $table->boolean('rcb_notif_resp_aluno')->default(1);
            $table->boolean('rcb_notif')->default(1);           

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
        Schema::dropIfExists('configuracoes_notificacoes_user');
    }
}
