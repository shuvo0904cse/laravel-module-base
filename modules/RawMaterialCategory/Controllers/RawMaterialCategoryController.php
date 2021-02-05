<?php


namespace Modules\RawMaterialCategory\Controllers;


use App\Helpers\MessageHelper;
use App\Helpers\SystemLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\RawMaterialCategory\Models\RawMaterialCategoryModel;

class RawMaterialCategoryController extends Controller
{
    /**
     * Raw Material Category
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function rawMaterialCategoryLists(Request $request, RawMaterialCategoryModel $rawMaterialCategoryModel)
    {
        try{
            $lists = $rawMaterialCategoryModel->rawMaterialCategoryLists($request->all());

            return MessageHelper::successMessage($lists);
        }
        catch(\Exception $e){
            SystemLog::error("rawMaterialCategoryLists", $e->getMessage());
            return MessageHelper::errorMessage();
        }
    }

    /**
     * Store Raw Material Category
     *
     * @param Request $request
     * @param RawMaterialCategoryModel $rawMaterialCategoryModel
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeRawMaterialCategory(Request $request, RawMaterialCategoryModel $rawMaterialCategoryModel)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required'
        ]);

        if ($validator->fails()) {
            return MessageHelper::validationErrorMessage($validator->errors()->messages());
        }

        try{
            $storeArray = [
                'user_id'         => 1,
                'name'            => $request->name,
                'description'     => $request->description,
            ];

            $array = $rawMaterialCategoryModel->storeData($storeArray);

            return MessageHelper::successMessage($array, config("messages.save_message"));
        }
        catch(\Exception $e){
            SystemLog::error("storeRawMaterialCategory", $e->getMessage());
            return MessageHelper::errorMessage();
        }
    }

    /**
     * Update Raw Material Category
     *
     * @param Request $request
     * @param RawMaterialCategoryModel $rawMaterialCategoryModel
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRawMaterialCategory(Request $request, RawMaterialCategoryModel $rawMaterialCategoryModel)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'id'    => 'required'
        ]);

        if ($validator->fails()) {
            return MessageHelper::validationErrorMessage($validator->errors()->messages());
        }

        try{
            $details = $rawMaterialCategoryModel->detailsById($request->id);

            if(!$details){
                return MessageHelper::errorMessage(null, config("messages.not_exists"));
            }

            $updateArray = [
                'name'            => $request->name,
                'description'     => $request->description,
            ];

            $rawMaterialCategoryModel->updateData($updateArray, $request->id);

            return MessageHelper::successMessage(null, config("messages.update_message"));
        }
        catch(\Exception $e){
            SystemLog::error("updateRawMaterialCategory", $e->getMessage());
            return MessageHelper::errorMessage();
        }
    }

    /**
     * Delete Raw Material Category
     *
     * @param Request $request
     * @param RawMaterialModel $rawMaterialCategoryModel
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRawMaterialCategory(Request $request, RawMaterialModel $rawMaterialCategoryModel)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return MessageHelper::validationErrorMessage($validator->errors()->messages());
        }

        try{
            $details = $rawMaterialCategoryModel->detailsById($request->id);

            if(!$details){
                return MessageHelper::errorMessage(null, config("messages.not_exists"));
            }

            $rawMaterialCategoryModel->deleteData($request->id);

            return MessageHelper::successMessage(null, config("messages.delete_message"));
        }
        catch(\Exception $e){
            SystemLog::error("deleteRawMaterialCategory", $e->getMessage());
            return MessageHelper::errorMessage();
        }
    }
}