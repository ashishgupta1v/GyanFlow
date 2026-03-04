<?php

use Illuminate\Support\Facades\Route;
use Modules\UserRetention\Http\Controllers\UserRetentionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('userretentions', UserRetentionController::class)->names('userretention');
});
