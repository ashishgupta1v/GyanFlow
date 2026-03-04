<?php

use Illuminate\Support\Facades\Route;
use Modules\UserRetention\Http\Controllers\UserRetentionController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('userretentions', UserRetentionController::class)->names('userretention');
});
