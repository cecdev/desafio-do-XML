<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAtividadePrincipalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('atividade_principal', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('empresas_id')->unsigned()->index('fk_atividade_principal_empresas1_idx');
			$table->integer('atividades_id')->index('fk_atividade_principal_atividades1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('atividade_principal');
	}

}
