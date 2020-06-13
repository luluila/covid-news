<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RoleUser
 * 
 * @property int $ID_ROLE
 * @property string|null $ROLE
 * 
 * @property Collection|EndUser[] $end_users
 *
 * @package App\Models
 */
class RoleUser extends Model
{
	protected $table = 'role_user';
	protected $primaryKey = 'ID_ROLE';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_ROLE' => 'int'
	];

	protected $fillable = [
		'ROLE'
	];

	public function end_users()
	{
		return $this->hasMany(EndUser::class, 'ID_ROLE');
	}
}
