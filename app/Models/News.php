<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class News
 * 
 * @property int $ID_NEWS
 * @property int|null $ID_VIEWER
 * @property int|null $ID_REGION
 * @property int|null $ID_CATEGORY_NEWS
 * @property string|null $TITLE
 * @property string|null $CONTENT
 * @property Carbon|null $CREATED_AT
 * @property Carbon|null $UPDATED_AT
 * 
 * @property CategoryNews $category_news
 * @property Region $region
 * @property Viewer $viewer
 * @property Collection|Viewer[] $viewers
 *
 * @package App\Models
 */
class News extends Model
{
	protected $table = 'news';
	protected $primaryKey = 'ID_NEWS';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_NEWS' => 'int',
		'ID_VIEWER' => 'int',
		'ID_REGION' => 'int',
		'ID_CATEGORY_NEWS' => 'int'
	];

	protected $dates = [
		'CREATED_AT',
		'UPDATED_AT'
	];

	protected $fillable = [
		'ID_VIEWER',
		'ID_REGION',
		'ID_CATEGORY_NEWS',
		'TITLE',
		'CONTENT',
		'CREATED_AT',
		'UPDATED_AT'
	];

	public function category_news()
	{
		return $this->belongsTo(CategoryNews::class, 'ID_CATEGORY_NEWS');
	}

	public function region()
	{
		return $this->belongsTo(Region::class, 'ID_REGION');
	}

	public function viewer()
	{
		return $this->belongsTo(Viewer::class, 'ID_VIEWER');
	}

	public function viewers()
	{
		return $this->hasMany(Viewer::class, 'ID_NEWS');
	}
}
