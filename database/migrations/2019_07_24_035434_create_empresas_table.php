<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmpresasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code', 45)->nullable();
			$table->date('data_situacao')->nullable();
			$table->string('nome')->nullable();
			$table->string('uf', 45)->nullable();
			$table->string('situacao', 45)->nullable();
			$table->string('bairro', 45)->nullable();
			$table->string('logradouro', 45)->nullable();
			$table->string('numero', 45)->nullable();
			$table->string('cep', 45)->nullable();
			$table->string('municipio', 45)->nullable();
			$table->string('porte', 45)->nullable();
			$table->string('abertura', 45)->nullable();
			$table->string('natureza_juridica', 45)->nullable();
			$table->string('cnpj', 45)->nullable();
			$table->dateTime('ultima_atualizacao')->nullable();
			$table->string('status', 45)->nullable();
			$table->string('tipo', 45)->nullable();
			$table->string('fantasia')->nullable();
			$table->string('complemento')->nullable();
			$table->string('email', 45)->nullable();
			$table->string('telefone', 45)->nullable();
			$table->string('efr', 45)->nullable();
			$table->string('motivo_situacao', 45)->nullable();
			$table->string('situacao_especial', 45)->nullable();
			$table->string('data_situacao_especial', 45)->nullable();
			$table->boolean('fake_generate')->nullable()->default(0);
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
		Schema::drop('empresas');
	}

}
