<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Region
 * 
 * @property int $ID_REGION
 * @property string|null $REGION
 * 
 * @property Collection|EndUser[] $end_users
 * @property Collection|GraphicInfo[] $graphic_infos
 * @property Collection|News[] $news
 *
 * @package App\Models
 */
class Region extends Model
{
	protected $table = 'region';
	protected $primaryKey = 'ID_REGION';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_REGION' => 'int'
	];

	protected $fillable = [
		'REGION'
	];

	public function end_users()
	{
		return $this->hasMany(EndUser::class, 'ID_REGION');
	}

	public function graphic_infos()
	{
		return $this->hasMany(GraphicInfo::class, 'ID_REGION');
	}

	public function news()
	{
		return $this->hasMany(News::class, 'ID_REGION');
	}
}
