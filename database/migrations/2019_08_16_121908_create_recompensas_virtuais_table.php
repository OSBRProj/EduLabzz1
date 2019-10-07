<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecompensasVirtuaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recompensas_virtuais', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id');
			$table->string('titulo');
			$table->text('descricao');
			$table->boolean('visibilidade')->default(1);
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
        Schema::dropIfExists('recompensas_virtuais');
    }
}
