<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\{
    BankController,
    BannerController,
    CampaignController,
    CategoryController,
    DashboardController,
    SettingController,
    UserProfileInformationController,
};

use App\Http\Controllers\Frontend\{
    AboutController,
    CampaignsController,
    ContactController,
    DonationController,
    HomeController,
    NewsController,
};

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

/* ========================================================================================= */
/* FRONT END */

Route::get('/', [HomeController::class, 'index'])->name('frontend.home');

Route::post('/subscribe', [HomeController::class, 'subscribe'])->name('frontend.subscribe');

Route::get('/donation', [DonationController::class, 'index'])->name('frontend.donation');
Route::get('/donation/{id}', [DonationController::class, 'detail'])->name('frontend.donation.detail');

Route::get('/news', [NewsController::class, 'index'])->name('frontend.news');

Route::get('/contact', [ContactController::class, 'index'])->name('frontend.contact');
Route::post('/contact', [ContactController::class, 'store'])->name('frontend.contact.store');

Route::get('/about', [AboutController::class, 'index'])->name('frontend.about');
/* ========================================================================================= */

Route::group([
    'middleware' => ['auth', 'role:admin,donatur']
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user/profile', [UserProfileInformationController::class, 'show'])->name('profile.show');
    Route::delete('/user/bank/{id}', [UserProfileInformationController::class, 'bank_destroy'])->name('profile.bank.destroy');

    Route::group([
        'middleware' => ['auth', 'role:admin']
    ], function () {
        // Master
        Route::resource('/category', CategoryController::class); // Untuk route dengan resource, Controller tidak boleh berbentuk array
        Route::resource('/bank', BankController::class); // Untuk route dengan resource, Controller tidak boleh berbentuk array
        Route::get('/campaign/data', [CampaignController::class, 'data'])->name('campaign.data');
        Route::get('/campaign/detail/{id}', [CampaignController::class, 'detail'])->name('campaign.detail');
        Route::resource('/campaign', CampaignController::class);

        // Pengaturan
        Route::resource('/banner', BannerController::class);
        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::put('/setting/{setting}', [SettingController::class, 'update'])->name('setting.update');
        Route::delete('/setting/{setting}/bank/{id}', [SettingController::class, 'bank_destroy'])->name('setting.bank.destroy');

        // Create Campaign
        Route::get('/campaigns', [CampaignsController::class, 'index'])->name('frontend.campaign.index');

        // Create Donation
        Route::get('/donation/create/{id}', [DonationController::class, 'create'])->name('frontend.donation.create');
    });

    Route::group([
        'middleware' => ['auth', 'role:donatur']
    ], function () {
    });
});
