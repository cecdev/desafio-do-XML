<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('data_users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->index('fk_data_users_users_idx');
			$table->string('nome', 100)->nullable();
			$table->string('sobrenome', 45)->nullable();
			$table->string('doc', 20)->nullable()->unique('cpf_UNIQUE');
			$table->string('skype', 100)->nullable();
			$table->string('whatsapp', 45)->nullable();
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
		Schema::drop('data_users');
	}

}
