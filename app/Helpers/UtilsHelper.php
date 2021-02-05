<?php


namespace App\Helpers;


use Illuminate\Support\Facades\File;

class UtilsHelper
{
    /**
     * Make Directory
     *
     * @param $targetLocation
     * @return mixed
     */
    public static function makeDirectory($targetLocation)
    {
        if (!is_dir($targetLocation)) {
            File::makeDirectory($targetLocation, 0777, true, true);
        }
        return $targetLocation;
    }


}