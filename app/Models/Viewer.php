<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Viewer
 * 
 * @property int $ID_VIEWER
 * @property int|null $ID_NEWS
 * @property int|null $COUNT
 * 
 * @property Collection|News[] $news
 *
 * @package App\Models
 */
class Viewer extends Model
{
	protected $table = 'viewer';
	protected $primaryKey = 'ID_VIEWER';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_VIEWER' => 'int',
		'ID_NEWS' => 'int',
		'COUNT' => 'int'
	];

	protected $fillable = [
		'ID_NEWS',
		'COUNT'
	];

	public function news()
	{
		return $this->hasMany(News::class, 'ID_VIEWER');
	}
}
