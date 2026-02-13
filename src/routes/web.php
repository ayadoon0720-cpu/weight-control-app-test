<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\GoalSettingController;
use App\Http\Controllers\Auth\RegisterStep1Controller;
use App\Http\Controllers\Auth\RegisterStep2Controller;

/*
|--------------------------------------------------------------------------
| 認証不要
|--------------------------------------------------------------------------
*/

// ログイン（Fortify）
Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

// 会員登録 STEP1
Route::get('/register/step1', [RegisterStep1Controller::class, 'create'])
    ->middleware('guest')
    ->name('register.step1');

Route::post('/register/step1', [RegisterStep1Controller::class, 'store'])
    ->middleware('guest')
    ->name('register.step1.store');

// 会員登録 STEP2（初期目標体重登録）
Route::get('/register/step2', [RegisterStep2Controller::class, 'create'])
    ->middleware('auth')
    ->name('register.step2');

Route::post('/register/step2', [RegisterStep2Controller::class, 'store'])
    ->middleware('auth')
    ->name('register.step2.store');

// ログアウト
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| 認証必須（体重管理）
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // トップページ（管理画面）
    Route::get('/weight_logs', [WeightLogController::class, 'index'])
        ->name('weight_logs.index');

    // 体重登録（モーダルPOST）
    Route::post('/weight_logs/create', [WeightLogController::class, 'store'])
        ->name('weight_logs.store');

    // 目標設定
    Route::get('/weight_logs/goal_setting', [GoalSettingController::class, 'edit'])
        ->name('weight_logs.goal_setting');

    Route::post('/weight_logs/goal_setting', [GoalSettingController::class, 'update'])
        ->name('weight_logs.goal_setting.update');

    // 体重検索
    Route::get('/weight_logs/search', [WeightLogController::class, 'search'])
        ->name('weight_logs.search');

    // 体重詳細（編集画面へ飛ばす想定）
    Route::get('/weight_logs/{weightLogId}', [WeightLogController::class, 'show'])
        ->name('weight_logs.show');

    // 体重更新
    Route::post('/weight_logs/{weightLogId}/update', [WeightLogController::class, 'update'])
        ->name('weight_logs.update');

    // 体重削除
    Route::post('/weight_logs/{weightLogId}/delete', [WeightLogController::class, 'destroy'])
        ->name('weight_logs.destroy');

});
