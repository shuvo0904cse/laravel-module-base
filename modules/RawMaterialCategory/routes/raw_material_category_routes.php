<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Modules\RawMaterialCategory\Controllers', 'prefix' => 'api/v1/'], function () {
    Route::post('raw-material-category-lists', 'RawMaterialCategoryController@rawMaterialCategoryLists')->name("raw_material_category_lists");
    Route::post('store-raw-material-category', 'RawMaterialCategoryController@storeRawMaterialCategory')->name("store_raw_material_category");
    Route::post('update-raw-material-category', 'RawMaterialCategoryController@updateRawMaterialCategory')->name("update_raw_material_category");
    Route::post('delete-raw-material-category', 'RawMaterialCategoryController@deleteRawMaterialCategory')->name("delete_raw_material_category");
});