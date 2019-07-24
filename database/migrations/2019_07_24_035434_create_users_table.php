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
			$table->integer('id', true);
			$table->string('code', 100)->unique('code_UNIQUE');
			$table->string('email', 60)->nullable();
			$table->string('password', 60)->nullable();
			$table->string('remember_token', 100)->nullable();
            $table->string('status', 45)->nullable();
            $table->integer('roles_id')->index('fk_users_roles1_idx');
			$table->timestamps();

			$table->softDeletes();
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
