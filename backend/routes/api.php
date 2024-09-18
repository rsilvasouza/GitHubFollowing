<?php

use App\Http\Controllers\GitHubController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(GitHubController::class)->group(function(){
    Route::get('/getUser/{user}/', 'getUser')->name('github.getUser');
});
