<?php


namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MessageHelper
{

    /**
     * Throw New Exception
     *
     * @param string $message
     * @throws \Exception
     */
    public static function throwExceptionMessage($message= "")
    {
        throw new \Exception($message,Response::HTTP_BAD_REQUEST );
    }

    /**
     * Throw Exception
     *
     * @param $exception
     * @throws \Exception
     */
    public static function throwException($exception)
    {
        $message = config("messages.400");
        if(!is_string($exception)){
            $message = $exception->getMessage();
            if($exception->getCode() == 0){
                $message = config("messages.400");
            }
        }
        throw new \Exception($message,Response::HTTP_BAD_REQUEST );
    }

    /**
     * Json Response
     *
     * @param null $results
     * @return JsonResponse
     */
    public static function jsonResponse($results = null)
    {
        return new JsonResponse($results, Response::HTTP_OK);
    }

    /**
     * Error Message
     *
     * @param null $errors
     * @param null $message
     * @return JsonResponse
     */
    public static function errorMessage($errors = null, $message = null)
    {
        return new JsonResponse([
            'key'       => "BAD_REQUEST",
            'message'   => empty($message) ? config("messages.400") : $message,
            'errors'    => $errors,
            'timestamp' => now()
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Validation Error Message
     *
     * @param null $errors
     * @param null $message
     * @return JsonResponse
     */
    public static function validationErrorMessage($errors = null, $message = null)
    {
        return new JsonResponse([
            'key'       => "VALIDATION_ERROR",
            'message'   => empty($message) ? config("messages.invalid_input") : $message,
            'errors'    => $errors,
            'timestamp' => now()
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Success Message
     *
     * @param null $results
     * @param null $message
     * @return JsonResponse
     */
    public static function successMessage($results = null, $message = null)
    {
        return new JsonResponse([
            'message'   => empty($message) ? config("messages.executed_successfully") : $message,
            'results'   => $results,
            'timestamp' => now()
        ], Response::HTTP_OK);
    }

    /**
     * Login Success Message
     *
     * @param $token
     * @param null $message
     * @return JsonResponse
     */
    public static function loginSuccessMessage($token, $message = null)
    {
        return new JsonResponse([
            'message'   => empty($message) ? config("messages.login_message") : $message,
            "type"      => "Bearer ",
            "token"     => $token,
            'timestamp' => now(),
        ], Response::HTTP_OK);
    }

}