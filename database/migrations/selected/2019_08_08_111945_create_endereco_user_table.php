<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnderecoUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('endereco_user', function(Blueprint $table)
		{
			$table->integer('user_id')->primary();
			$table->string('cep', 9)->nullable();
			$table->string('uf', 2)->nullable();
			$table->string('cidade', 100)->nullable();
			$table->string('bairro', 100)->nullable();
			$table->string('logradouro')->nullable();
			$table->string('numero')->nullable();
			$table->string('complemento')->nullable();
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
		Schema::drop('endereco_user');
	}

}
