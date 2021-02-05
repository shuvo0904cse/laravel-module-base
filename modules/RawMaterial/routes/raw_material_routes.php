<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Modules\RawMaterial\Controllers', 'prefix' => 'api/v1/'], function () {
    Route::post('raw-material-lists', 'RawMaterialController@rawMaterialLists')->name("raw_material_lists");
    Route::post('store-raw-material', 'RawMaterialController@storeRawMaterial')->name("store_raw_material");
    Route::post('update-raw-material', 'RawMaterialController@updateRawMaterial')->name("update_raw_material");
    Route::post('delete-raw-material', 'RawMaterialController@deleteRawMaterial')->name("delete_raw_material");
});