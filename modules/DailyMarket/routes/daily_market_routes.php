<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Modules\DailyMarket\Controllers', 'prefix' => 'api/v1/'], function () {
    Route::post('daily-market-lists', 'DailyMarketController@dailyMarketLists')->name("daily_market_lists");
    Route::post('store-daily-market', 'DailyMarketController@storeDailyMarket')->name("store_daily_market");
    Route::post('update-daily-market', 'DailyMarketController@updateDailyMarket')->name("update_daily_market");
    Route::post('delete-daily-market', 'DailyMarketController@deleteDailyMarket')->name("delete_daily_market");
});