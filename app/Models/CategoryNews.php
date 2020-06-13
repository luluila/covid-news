<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryNews
 * 
 * @property int $ID_CATEGORY_NEWS
 * @property string|null $CATEGORY
 * 
 * @property Collection|News[] $news
 *
 * @package App\Models
 */
class CategoryNews extends Model
{
	protected $table = 'category_news';
	protected $primaryKey = 'ID_CATEGORY_NEWS';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_CATEGORY_NEWS' => 'int'
	];

	protected $fillable = [
		'CATEGORY'
	];

	public function news()
	{
		return $this->hasMany(News::class, 'ID_CATEGORY_NEWS');
	}
}
