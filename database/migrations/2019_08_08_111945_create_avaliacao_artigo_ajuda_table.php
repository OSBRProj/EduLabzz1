<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAvaliacaoArtigoAjudaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avaliacao_artigo_ajuda', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('artigo_ajuda_id');
			$table->integer('user_id');
			$table->integer('avaliacao');
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
		Schema::drop('avaliacao_artigo_ajuda');
	}

}
