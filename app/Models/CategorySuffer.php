<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategorySuffer
 * 
 * @property int $ID_SUFFER
 * @property string|null $CATEGORY_SUFFER
 * 
 * @property Collection|GraphicInfo[] $graphic_infos
 *
 * @package App\Models
 */
class CategorySuffer extends Model
{
	protected $table = 'category_suffer';
	protected $primaryKey = 'ID_SUFFER';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_SUFFER' => 'int'
	];

	protected $fillable = [
		'CATEGORY_SUFFER'
	];

	public function graphic_infos()
	{
		return $this->hasMany(GraphicInfo::class, 'ID_SUFFER');
	}
}
