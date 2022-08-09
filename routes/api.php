<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\TechnicalTaskController;
use App\Http\Controllers\Api\OnpageTaskController;
use App\Http\Controllers\Api\MonthlyTaskController;
use App\Http\Controllers\Api\MeetingNoteController;
use App\Http\Controllers\Api\ProjectActivityController;





/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

 
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);
  
Route::middleware('auth:api')->group(function () {
    Route::get('get-user', [PassportAuthController::class, 'userInfo']);
    Route::resource('products', ProductController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('pages', PageController::class);
    Route::resource('topics', TopicController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('technicaltasks', TechnicalTaskController::class);
    Route::resource('onpagetasks', OnpageTaskController::class);
    Route::resource('monthlytasks', MonthlyTaskController::class);
    Route::resource('meetingnotes', MeetingNoteController::class);
    Route::resource('projectactivities', ProjectActivityController::class);

});