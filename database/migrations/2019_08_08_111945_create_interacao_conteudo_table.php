<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInteracaoConteudoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interacao_conteudo', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('conteudo_id');
			$table->integer('user_id');
			$table->integer('tipo');
			$table->timestamp('inicio')->default(DB::raw('CURRENT_TIMESTAMP'));
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
		Schema::drop('interacao_conteudo');
	}

}
