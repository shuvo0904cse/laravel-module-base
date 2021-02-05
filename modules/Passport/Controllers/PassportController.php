<?php


namespace Modules\Passport\Controllers;


use App\Helpers\MessageHelper;
use App\Helpers\SystemLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Passport\Models\RawMaterialCategoryModel;

class PassportController extends Controller
{

    /**
     * Post Login
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email"     => 'required',
            "password"  => 'required',
        ]);

        if ($validator->fails()) {
            return MessageHelper::validationErrorMessage($validator->errors()->messages());
        }

        try{
            $credentials = [
                'email'     => $request->email,
                'password'  => $request->password
            ];

            if (Auth::attempt($credentials)) {
                $token = auth()->user()->createToken(config("setting.login_token_name"))->accessToken;

                return MessageHelper::loginSuccessMessage($token);
            }else{
                return MessageHelper::errorMessage(null, config("messages.unauthorised"));
            }
        }
        catch(\Exception $e){
            SystemLog::error("postLogin", $e->getMessage());
            return MessageHelper::errorMessage();
        }
    }


    /**
     * Post Register
     *
     * @param Request $request
     * @param RawMaterialCategoryModel $userModel
     * @return \Illuminate\Http\JsonResponse
     */
    public function postRegister(Request $request, RawMaterialCategoryModel $userModel)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required',
            'email'             => 'required|email|unique:users',
            'password'          => 'required',
            'confirm_password'  => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return MessageHelper::validationErrorMessage($validator->errors()->messages());
        }

        try{
            $userArray = [
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password)
            ];

            $user = $userModel->storeData($userArray);

            return MessageHelper::successMessage($user,config("messages.save_message"));
        }
        catch(\Exception $e){
            SystemLog::error("postRegister", $e->getMessage());
            return MessageHelper::errorMessage();
        }
    }
}