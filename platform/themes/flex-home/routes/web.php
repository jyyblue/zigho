<?php

use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;
use Theme\FlexHome\Http\Controllers\FlexHomeController;

Route::group(['controller' => FlexHomeController::class, 'middleware' => ['web', 'core']], function () {
    Theme::registerRoutes(function () {
        Route::get('wishlist', 'getWishlist')->name('public.wishlist');

        Route::group(['prefix' => 'ajax', 'as' => 'public.ajax.'], function () {
            Route::get('cities', 'ajaxGetCities')->name('cities');
            Route::get('properties/map', 'ajaxGetPropertiesForMap')->name('properties.map');
            Route::get('projects-filter', 'ajaxGetProjectsFilter')->name('projects-filter');
        });
    });
});

Theme::routes();
