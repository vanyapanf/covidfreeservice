<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\IllnessController;
use App\Http\Controllers\RecoveryController;
use App\Http\Controllers\FaqController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/index', [IndexController::class, 'index']);
Route::get('/index/{post_id}/files', [IndexController::class, 'getFilesByPost']);
Route::get('/index/{post_id}/comments', [IndexController::class, 'getCommentsByPost']);
Route::get('/index/{post_id}/new_comment', [IndexController::class, 'createComment']);
Route::get('/user/{user_id}', [UserProfileController::class, 'userProfile']);
Route::get('/user/{user_id}/{report_id}/messages', [UserProfileController::class, 'openMessages']);
Route::get('/user/{user_id}/{report_id}/new_message', [UserProfileController::class, 'createMessage']);
Route::get('/user/{user_id}/new_tracker_card', [UserProfileController::class, 'createTrackerCard']);
Route::get('/admin/{admin_id}', [AdminProfileController::class, 'adminProfile']);
Route::get('/admin/{admin_id}/new_post', [AdminProfileController::class, 'createPost']);
Route::get('/admin/{admin_id}/add_admin', [AdminProfileController::class, 'addAdmin']);
Route::get('/admin/{admin_id}/{report_id}/illness', [AdminProfileController::class, 'acceptIllnessReport']);
Route::get('/admin/{admin_id}/{report_id}/recovery', [AdminProfileController::class, 'acceptRecoveryReport']);
Route::get('/admin/{admin_id}/{report_id}/cancel', [AdminProfileController::class, 'cancelReport']);
Route::get('/admin/{admin_id}/{report_id}/report_doc', [AdminProfileController::class, 'viewReportDoc']);
Route::get('/admin/{admin_id}/{report_id}/messages', [AdminProfileController::class, 'openMessages']);
Route::get('/admin/{admin_id}/{report_id}/new_message', [AdminProfileController::class, 'createMessage']);
Route::get('/illness', [IllnessController::class, 'illness']);
Route::get('/illness/new_report', [IllnessController::class, 'createIllnessReport']);
Route::get('/illness/add_confirm', [IllnessController::class, 'addConfirmToIllnessReport']);
Route::get('/recovery', [RecoveryController::class, 'recovery']);
Route::get('/recovery/new_report', [RecoveryController::class, 'createRecoveryReport']);
Route::get('/recovery/add_confirm', [RecoveryController::class, 'addConfirmToRecoveryReport']);
Route::get('/faq', [FaqController::class, '']);
