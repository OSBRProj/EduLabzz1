<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToFavoritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('favoritos', function (Blueprint $table) {
            $table->integer('conteudo_id')->nullable();
            $table->integer('album_id')->nullable();
            $table->integer('audio_id')->nullable();
        });
    }




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('favoritos', function (Blueprint $table) {
            $table->dropColumn('conteudo_id');
            $table->dropColumn('album_id');
            $table->dropColumn('audio_id');
        });
    }
}


