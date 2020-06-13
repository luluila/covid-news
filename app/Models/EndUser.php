<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EndUser
 * 
 * @property int $ID_USER
 * @property int|null $ID_REGION
 * @property int|null $ID_ROLE
 * @property string|null $USERNAME
 * @property string|null $EMAIL
 * @property float|null $TELEPHONE
 * @property string|null $PASSWORD
 * 
 * @property RoleUser $role_user
 * @property Region $region
 *
 * @package App\Models
 */
class EndUser extends Model
{
	protected $table = 'end_user';
	protected $primaryKey = 'ID_USER';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_USER' => 'int',
		'ID_REGION' => 'int',
		'ID_ROLE' => 'int',
		'TELEPHONE' => 'float'
	];

	protected $fillable = [
		'ID_REGION',
		'ID_ROLE',
		'USERNAME',
		'EMAIL',
		'TELEPHONE',
		'PASSWORD'
	];

	public function role_user()
	{
		return $this->belongsTo(RoleUser::class, 'ID_ROLE');
	}

	public function region()
	{
		return $this->belongsTo(Region::class, 'ID_REGION');
	}
}
