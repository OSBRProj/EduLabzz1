<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEscolasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('escolas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('titulo');
			$table->text('descricao');
			$table->string('capa');
			$table->boolean('postagem_aberta')->nullable();
			$table->integer('limite_alunos');
			$table->string('nome_completo')->nullable();
			$table->string('cnpj')->nullable();
			$table->string('nome_responsavel')->nullable();
			$table->string('email_responsavel')->nullable();
			$table->string('telefone_responsavel')->nullable();
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
		Schema::drop('escolas');
	}

}
