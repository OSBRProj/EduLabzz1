<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransacoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transacoes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('referencia_id')->nullable();
			$table->integer('user_id');
			$table->float('sub_total', 10, 0);
			$table->float('adicional', 10, 0)->nullable();
			$table->float('desconto', 10, 0)->nullable();
			$table->float('frete', 10, 0)->nullable();
			$table->float('total', 10, 0);
			$table->integer('status');
			$table->string('metodo');
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
		Schema::drop('transacoes');
	}

}
