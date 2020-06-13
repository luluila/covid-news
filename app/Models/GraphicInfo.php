<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GraphicInfo
 * 
 * @property int $ID_INFO
 * @property int|null $ID_SUFFER
 * @property int|null $ID_REGION
 * @property int|null $LAST_TOTAL_COUNT
 * @property int|null $DIFFERENCE
 * @property Carbon|null $CREATED_AT
 * 
 * @property Region $region
 * @property CategorySuffer $category_suffer
 *
 * @package App\Models
 */
class GraphicInfo extends Model
{
	protected $table = 'graphic_info';
	protected $primaryKey = 'ID_INFO';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_INFO' => 'int',
		'ID_SUFFER' => 'int',
		'ID_REGION' => 'int',
		'LAST_TOTAL_COUNT' => 'int',
		'DIFFERENCE' => 'int'
	];

	protected $dates = [
		'CREATED_AT'
	];

	protected $fillable = [
		'ID_SUFFER',
		'ID_REGION',
		'LAST_TOTAL_COUNT',
		'DIFFERENCE',
		'CREATED_AT'
	];

	public function region()
	{
		return $this->belongsTo(Region::class, 'ID_REGION');
	}

	public function category_suffer()
	{
		return $this->belongsTo(CategorySuffer::class, 'ID_SUFFER');
	}
}
