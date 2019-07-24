<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAtividadePrincipalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('atividade_principal', function(Blueprint $table)
		{
			$table->foreign('atividades_id', 'fk_atividade_principal_atividades1')->references('id')->on('atividades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('empresas_id', 'fk_atividade_principal_empresas1')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('atividade_principal', function(Blueprint $table)
		{
			$table->dropForeign('fk_atividade_principal_atividades1');
			$table->dropForeign('fk_atividade_principal_empresas1');
		});
	}

}
