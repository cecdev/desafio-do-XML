<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 24 Jul 2019 03:55:03 +0000.
 */

namespace App\Entities;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Empresa
 * 
 * @property int $id
 * @property string $code
 * @property \Carbon\Carbon $data_situacao
 * @property string $nome
 * @property string $uf
 * @property string $situacao
 * @property string $bairro
 * @property string $logradouro
 * @property string $numero
 * @property string $cep
 * @property string $municipio
 * @property string $porte
 * @property string $abertura
 * @property string $natureza_juridica
 * @property string $cnpj
 * @property \Carbon\Carbon $ultima_atualizacao
 * @property string $status
 * @property string $tipo
 * @property string $fantasia
 * @property string $complemento
 * @property string $email
 * @property string $telefone
 * @property string $efr
 * @property string $motivo_situacao
 * @property string $situacao_especial
 * @property string $data_situacao_especial
 * @property int $fake_generate
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $atividade_principals
 * @property \Illuminate\Database\Eloquent\Collection $atividades_secundarias
 *
 * @package App\Entities
 */
class Empresa extends Eloquent
{
	protected $connection = 'mysql';

	protected $casts = [
		'fake_generate' => 'int'
	];

	protected $dates = [
		'data_situacao',
		'ultima_atualizacao'
	];

	protected $fillable = [
		'code',
		'data_situacao',
		'nome',
		'uf',
		'situacao',
		'bairro',
		'logradouro',
		'numero',
		'cep',
		'municipio',
		'porte',
		'abertura',
		'natureza_juridica',
		'cnpj',
		'ultima_atualizacao',
		'status',
		'tipo',
		'fantasia',
		'complemento',
		'email',
		'telefone',
		'efr',
		'motivo_situacao',
		'situacao_especial',
		'data_situacao_especial',
		'fake_generate'
	];

	public function atividade_principals()
	{
		return $this->hasMany(\App\Entities\AtividadePrincipal::class, 'empresas_id');
	}

	public function atividades_secundarias()
	{
		return $this->hasMany(\App\Entities\AtividadesSecundaria::class, 'empresas_id');
	}
}
