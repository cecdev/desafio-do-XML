<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 24 Jul 2019 03:55:03 +0000.
 */

namespace App\Entities;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Role
 * 
 * @property int $id
 * @property string $name
 * @property string $label
 * 
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package App\Entities
 */
class Role extends Eloquent
{
	protected $connection = 'mysql';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'label'
	];

	public function users()
	{
		return $this->hasMany(\App\Entities\User::class, 'roles_id');
	}
}
