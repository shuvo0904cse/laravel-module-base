<?php


namespace Modules\RawMaterialCategory\Models;


use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterialCategoryModel extends BaseModel
{
    use SoftDeletes;

    protected   $table = 'raw_material_categories';

    protected $fillable = [
        'user_id',
        'name',
        'description',
    ];

    /**
     * Raw Material Category Lists
     * @param array $request
     * @param int $limit
     * @return mixed
     */
    public function rawMaterialCategoryLists($request = [], $limit = 10)
    {
        $query = self::latest();

        $search = isset($request->search) ? $request->search : null;
        if(!empty($search)){
            $query = $query->where('name', 'LIKE', '%' . $search . '%');
        }
        return $query->paginate($limit);
    }
}