<?php


namespace Modules\DailyMarket\Controllers;


use App\Helpers\MessageHelper;
use App\Helpers\SystemLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\DailyMarket\Models\DailyMarketModel;

class DailyMarketController extends Controller
{
    /**
     * Raw Material Lists
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dailyMarketLists(Request $request, DailyMarketModel $dailyMarketModel)
    {
        try{
            $lists = $dailyMarketModel->dailyMarketLists($request->all());

            return MessageHelper::successMessage($lists);
        }
        catch(\Exception $e){
            SystemLog::error("dailyMarketLists", $e->getMessage());
            return MessageHelper::errorMessage();
        }
    }

    /**
     * Store Raw Material
     *
     * @param Request $request
     * @param DailyMarketModel $rawMaterialModel
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeDailyMarket(Request $request, DailyMarketModel $rawMaterialModel)
    {
        $validator = Validator::make($request->all(), [
            'name'                      => 'required',
            'measurement'               => 'required',
            'raw_material_category_id'  => 'required'
        ]);

        if ($validator->fails()) {
            return MessageHelper::validationErrorMessage($validator->errors()->messages());
        }

        try{
            $storeArray = [
                'user_id'                   => 1,
                'name'                      => $request->name,
                'measurement_amount'        => $request->measurement_amount,
                'measurement'               => $request->measurement,
                'description'               => $request->description,
                'raw_material_category_id'  => $request->raw_material_category_id,
            ];

            $array = $rawMaterialModel->storeData($storeArray);

            return MessageHelper::successMessage($array, config("messages.save_message"));
        }
        catch(\Exception $e){
            SystemLog::error("storeRawMaterial", $e->getMessage());
            return MessageHelper::errorMessage();
        }
    }

    /**
     * Update Raw Material Category
     *
     * @param Request $request
     * @param DailyMarketModel $rawMaterialModel
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateDailyMarket(Request $request, DailyMarketModel $rawMaterialModel)
    {
        $validator = Validator::make($request->all(), [
            'name'                      => 'required',
            'measurement'               => 'required',
            'raw_material_category_id'  => 'required',
            'id'                        => 'required'
        ]);

        if ($validator->fails()) {
            return MessageHelper::validationErrorMessage($validator->errors()->messages());
        }

        try{
            $details = $rawMaterialModel->detailsById($request->id);

            if(!$details){
                return MessageHelper::errorMessage(null, config("messages.not_exists"));
            }

            $updateArray = [
                'user_id'                   => 1,
                'name'                      => $request->name,
                'measurement_amount'        => $request->measurement_amount,
                'measurement'               => $request->measurement,
                'description'               => $request->description,
                'raw_material_category_id'  => $request->raw_material_category_id,
            ];

            $rawMaterialModel->updateData($updateArray, $request->id);

            return MessageHelper::successMessage(null, config("messages.update_message"));
        }
        catch(\Exception $e){
            SystemLog::error("updateRawMaterial", $e->getMessage());
            return MessageHelper::errorMessage();
        }
    }

    /**
     * Delete Raw Material
     *
     * @param Request $request
     * @param DailyMarketModel $rawMaterialModel
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteDailyMarket(Request $request, DailyMarketModel $rawMaterialModel)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return MessageHelper::validationErrorMessage($validator->errors()->messages());
        }

        try{
            $details = $rawMaterialModel->detailsById($request->id);

            if(!$details){
                return MessageHelper::errorMessage(null, config("messages.not_exists"));
            }

            $rawMaterialModel->deleteData($request->id);

            return MessageHelper::successMessage(null, config("messages.delete_message"));
        }
        catch(\Exception $e){
            SystemLog::error("deleteRawMaterial", $e->getMessage());
            return MessageHelper::errorMessage();
        }
    }
}