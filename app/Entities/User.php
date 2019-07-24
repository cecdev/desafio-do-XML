<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 24 Jul 2019 03:55:03 +0000.
 */

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $connection = 'mysql';

	protected $casts = [
		'roles_id' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'code',
		'email',
		'password',
		'remember_token',
		'status',
		'roles_id'
	];

	public function role()
	{
		return $this->belongsTo(\App\Entities\Role::class, 'roles_id');
	}

	public function data_users()
	{
		return $this->hasMany(\App\Entities\DataUser::class);
	}

	public function xml_download_controls()
	{
		return $this->hasMany(\App\Entities\XmlDownloadControl::class, 'users_id');
	}
}
