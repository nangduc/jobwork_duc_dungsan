<?php

use App\Http\Controllers\Api\v1\CommentController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'comments'], function () {
  Route::get('/report/{reportId}', [CommentController::class, 'getCommentsByReportId']);
  Route::post('', [CommentController::class, 'store']);
  Route::put('{id}', [CommentController::class, 'update']);
  Route::delete('{id}', [CommentController::class, 'destroy']);
});
