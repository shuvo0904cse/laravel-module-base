<?php


namespace Modules\RawMaterial\Models;


use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\RawMaterialCategory\Models\RawMaterialCategoryModel;

class RawMaterialModel extends BaseModel
{
    use SoftDeletes;

    protected   $table = 'raw_materials';

    protected $fillable = [
        'user_id',
        'name',
        'measurement_amount',
        'measurement',
        'raw_material_category_id',
        'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rawMaterialCategory()
    {
        return $this->belongsTo(RawMaterialCategoryModel::class, 'raw_material_category_id', 'id');
    }
    /**
     * Raw Material Category Lists
     * @param array $request
     * @param int $limit
     * @return mixed
     */
    public function rawMaterialLists($request = [], $limit = 10)
    {
        $query = self::with("rawMaterialCategory")->latest();

        $search = isset($request->search) ? $request->search : null;
        if(!empty($search)){
            $query = $query->where('name', 'LIKE', '%' . $search . '%');
        }
        return $query->paginate($limit);
    }
}