<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAplicacoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aplicacoes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('titulo');
			$table->text('descricao', 65535);
			$table->integer('status');
			$table->integer('liberada');
			$table->boolean('destaque');
			$table->dateTime('data_lancamento')->nullable();
			$table->string('capa');
			$table->integer('categoria_id');
			$table->string('nivel_ensino')->nullable();
			$table->string('ano_serie')->nullable();
			$table->text('tags', 65535)->nullable();
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
		Schema::drop('aplicacoes');
	}

}
