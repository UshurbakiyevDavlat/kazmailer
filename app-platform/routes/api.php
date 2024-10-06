<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:sanctum')->group(function () { todo return when auth logic will be done
    Route::group(['prefix' => 'v1'], function () {
        Route::group(['prefix' => 'campaigns'], function () {
            Route::get('/', [CampaignController::class, 'index']);
            Route::post('/', [CampaignController::class, 'store']);
            Route::get('/{id}', [CampaignController::class, 'show']);
            Route::put('/{id}', [CampaignController::class, 'update']);
            Route::delete('/{id}', [CampaignController::class, 'destroy']);
            Route::post('/{id}/send', [CampaignController::class, 'send']); // Отправка кампании
        });

        Route::group(['prefix' => 'subscribers'], function () {
            Route::get('/', [SubscriberController::class, 'index']);
            Route::post('/', [SubscriberController::class, 'store']);
            Route::put('/{id}', [SubscriberController::class, 'update']);
            Route::delete('/{id}', [SubscriberController::class, 'destroy']);
            Route::post('/import', [SubscriberController::class, 'import']); // Импорт подписчиков через CSV
        });
    });
//});