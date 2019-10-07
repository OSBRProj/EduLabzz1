<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProdutoTransacaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produto_transacao', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('transacao_id');
			$table->integer('user_id');
			$table->integer('produto_id');
			$table->string('titulo');
			$table->text('descricao', 65535);
			$table->integer('tipo');
			$table->float('valor', 10, 0);
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
		Schema::drop('produto_transacao');
	}

}
