<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BankController;
use App\Http\Controllers\Backend\CampaignController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\UserProfileInformationController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\CampaignController as FrontendCampaignController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/campaigns', [FrontendCampaignController::class, 'index'])->name('frontend.campaign');
Route::get('/contact', [ContactController::class, 'index'])->name('frontend.contact');
Route::get('/about', [AboutController::class, 'index'])->name('frontend.about');

Route::group([
    'middleware' => ['auth', 'role:admin,donatur']
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user/profile', [UserProfileInformationController::class, 'show'])->name('profile.show');
    Route::delete('/user/bank/{id}', [UserProfileInformationController::class, 'bank_destroy'])->name('profile.bank.destroy');

    Route::group([
        'middleware' => ['auth', 'role:admin']
    ], function () {
        Route::resource('/category', CategoryController::class); // Untuk route dengan resource, Controller tidak boleh berbentuk array
        Route::resource('/bank', BankController::class); // Untuk route dengan resource, Controller tidak boleh berbentuk array

        Route::get('/campaign/data', [CampaignController::class, 'data'])->name('campaign.data');
        Route::get('/campaign/detail/{id}', [CampaignController::class, 'detail'])->name('campaign.detail');
        Route::resource('/campaign', CampaignController::class)->except('create', 'edit');

        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::put('/setting/{setting}', [SettingController::class, 'update'])->name('setting.update');
        Route::delete('/setting/{setting}/bank/{id}', [SettingController::class, 'bank_destroy'])->name('setting.bank.destroy');
    });

    Route::group([
        'middleware' => ['auth', 'role:donatur']
    ], function () {
    });
});
