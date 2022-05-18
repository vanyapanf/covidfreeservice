<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\IllnessController;
use App\Http\Controllers\RecoveryController;
use App\Http\Controllers\ReportProcessController;
use App\Http\Controllers\ReportDiscussionController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
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

Route::get('/index', [IndexController::class, 'index'])->middleware('auth')->name('index');
Route::get('/post/{post_id}', [PostController::class, 'post'])->middleware('auth')->name('post');
Route::post('/post/{post_id}/new_comment', [PostController::class, 'createComment'])->middleware('auth')->name('create_comment');
Route::get('/user', [UserProfileController::class, 'userProfile'])->middleware('auth')->name('user');
Route::post('/user/new_tracker_card', [UserProfileController::class, 'createTrackerCard'])->middleware('auth')->name('create_trackercard');
Route::get('/profile',[ProfileController::class, 'profile'])->middleware('auth')->name('profile');
Route::post('/profile/save_changes',[ProfileController::class, 'saveProfileChanges'])->middleware('auth')->name('save_profilechanges');
Route::get('/admin', [AdminProfileController::class, 'adminProfile'])->middleware('auth')->name('admin');
Route::post('/admin/new_post', [AdminProfileController::class, 'createPost'])->middleware('auth')->name('new_post');
Route::post('/admin/add_admin', [AdminProfileController::class, 'addAdmin'])->middleware('auth')->name('add_admin');
Route::get('/report_process', [ReportProcessController::class, 'reportProcess'])->middleware('auth')->name('report_process');
Route::post('/report_process/{report_id}/accept', [ReportProcessController::class, 'acceptReport'])->middleware('auth')->name('accept_report');
Route::post('/report_process/{report_id}/cancel', [ReportProcessController::class, 'cancelReport'])->middleware('auth')->name('cancel_report');
Route::get('/report_process/{report_id}/close_discussion', [ReportProcessController::class, 'closeDiscussion'])->middleware('auth')->name('close_discussion');
Route::get('/report_discussion/{report_id}', [ReportDiscussionController::class, 'reportDiscussion'])->middleware('auth')->name('report_discussion');
Route::post('/report_discussion/{report_id}/new_message', [ReportDiscussionController::class, 'createMessage'])->middleware('auth')->name('create_message');
Route::get('/illness', [IllnessController::class, 'illness'])->middleware('auth')->name('illness');
Route::post('/illness/new_report', [IllnessController::class, 'createIllnessReport'])->middleware('auth')->name('create_illnessreport');
Route::post('/illness/add_confirm', [IllnessController::class, 'addConfirmToIllnessReport'])->middleware('auth')->name('confirm_illnessreport');
Route::get('/recovery', [RecoveryController::class, 'recovery'])->middleware('auth')->name('recovery');
Route::post('/recovery/new_report', [RecoveryController::class, 'createRecoveryReport'])->middleware('auth')->name('create_recoveryreport');
Route::post('/recovery/add_confirm', [RecoveryController::class, 'addConfirmToRecoveryReport'])->middleware('auth')->name('confirm_recoveryreport');
Route::get('/faq', [FaqController::class, ''])->middleware('auth');

Route::get('/login', function(){
    if(Auth::check()){
        return redirect(route('index'));
    }
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', function(){
    Auth::logout();
    return redirect(route('index'));
})->name('logout');

Route::get('/registration', function(){
    if(Auth::check()){
        return redirect(route('index'));
    }
    return view('auth.registration');
})->name('registration');

Route::post('/registration', [RegisterController::class, 'save']);

Route::get('/forgot_password', function(){
    return view('auth.forgot_password');
})->name('forgot_password');

Route::post('/forgot_password', [ForgotPasswordController::class, 'forgot']);

