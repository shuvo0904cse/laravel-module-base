<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Details By Id
     *
     * @param $id
     * @param string $columnName
     * @return mixed
     */
    public function detailsById($id, $columnName = "id")
    {
        return self::where($columnName, $id)->first();
    }

    /**
     * Store Data
     *
     * @param $array
     * @return mixed
     */
    public function storeData($array)
    {
        return self::create($array);
    }

    /**
     * Update Data
     *
     * @param $array
     * @param $id
     * @param string $columnName
     * @return mixed
     */
    public function updateData($array, $id, $columnName = "id")
    {
        return self::where($columnName, $id)->update($array);
    }

    /**
     * Delete Data
     *
     * @param $id
     * @param string $columnName
     * @return mixed
     */
    public function deleteData($id, $columnName= "id")
    {
        return self::where($columnName, $id)->delete();
    }
}