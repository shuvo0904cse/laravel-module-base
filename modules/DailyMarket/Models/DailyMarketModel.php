<?php


namespace Modules\DailyMarket\Models;


use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\RawMaterial\Models\RawMaterialModel;

class DailyMarketModel extends BaseModel
{
    use SoftDeletes;

    protected   $table = 'daily_markets';

    protected $fillable = [
        'user_id',
        'raw_material_id',
        'measurement_amount',
        'payment_amount',
        'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterialModel::class, 'raw_material_id', 'id');
    }
    /**
     * Raw Material Category Lists
     * @param array $request
     * @param int $limit
     * @return mixed
     */
    public function dailyMarketLists($request = [], $limit = 10)
    {
        $query = self::with("rawMaterialCategory")->latest();

        $search = isset($request->search) ? $request->search : null;
        if(!empty($search)){
            $query = $query->where('name', 'LIKE', '%' . $search . '%');
        }
        return $query->paginate($limit);
    }
}