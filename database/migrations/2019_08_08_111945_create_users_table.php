<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email', 250)->unique();
			$table->string('password');
			$table->string('ra', 10)->nullable()->unique('ra');
			$table->string('img_perfil');
			$table->string('nome_completo');
			$table->date('data_nascimento')->nullable();
			$table->string('genero', 10);
			$table->text('descricao')->nullable();
			$table->integer('escola_id');
			$table->string('permissao', 10);
			$table->string('remember_token', 100)->nullable();
			$table->timestamp('ultima_atividade')->default(DB::raw('CURRENT_TIMESTAMP'));
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
		Schema::drop('users');
	}

}
