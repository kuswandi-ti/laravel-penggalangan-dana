<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\{
    BankController,
    BannerController,
    CampaignController as BackendCampaignController,
    CategoryController,
    ContactController as BackendContactController,
    DashboardController,
    DonaturController,
    SettingController,
    SubscriberController,
    UserProfileInformationController,
};

use App\Http\Controllers\Frontend\{
    AboutController,
    CampaignController as FrontendCampaignController,
    ContactController as FrontendContactController,
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

// Route::get('/campaign/data', [BackendCampaignController::class, 'data'])->name('campaign.data');

// Untuk route dengan resource, Controller tidak boleh berbentuk array

/* ========================================================================================= */
/* FRONTEND - GUEST */
/* ========================================================================================= */

Route::get('/', [HomeController::class, 'index'])->name('frontend.home.index');
Route::get('/about', [AboutController::class, 'index'])->name('frontend.about.index');
Route::get('/donation', [DonationController::class, 'index'])->name('frontend.donation.index');
Route::get('/donation/{id}', [DonationController::class, 'detail'])->name('frontend.donation.detail');
Route::get('/news', [NewsController::class, 'index'])->name('frontend.news.index');
Route::get('/contact', [FrontendContactController::class, 'index'])->name('frontend.contact.index');
Route::post('/contact', [FrontendContactController::class, 'store'])->name('frontend.contact.store');
Route::post('/subscriber', [HomeController::class, 'subscriber'])->name('frontend.subscriber.store');

/* ========================================================================================= */

/* ========================================================================================= */
/* BACKEND - ADMIN */
/* ========================================================================================= */

Route::group([
    'middleware' => ['auth', 'role:admin'],
    'prefix' => 'admin',
], function () {
    // Master
    Route::resource('/bank', BankController::class, ['as' => 'backend']);
    Route::resource('/category', CategoryController::class, ['as' => 'backend']);
    Route::resource('/campaign', BackendCampaignController::class, ['as' => 'backend']);
    Route::get('/campaign/detail/{id}', [BackendCampaignController::class, 'detail'])->name('backend.campaign.detail');

    // Referensi
    Route::resource('/donatur', DonaturController::class, ['as' => 'backend']);
    Route::get('/contact/data', [BackendContactController::class, 'data'])->name('backend.contact.data');
    Route::resource('/contact', BackendContactController::class, ['as' => 'backend']);
    Route::get('/subscriber/data', [SubscriberController::class, 'data'])->name('backend.subscriber.data');
    Route::resource('/subscriber', SubscriberController::class, ['as' => 'backend']);

    // Pengaturan
    Route::resource('/banner', BannerController::class, ['as' => 'backend']);
    Route::get('/setting', [SettingController::class, 'index'])->name('backend.setting.index');
    Route::put('/setting/{setting}', [SettingController::class, 'update'])->name('backend.setting.update');
    Route::delete('/setting/{setting}/bank/{id}', [SettingController::class, 'bank_destroy'])->name('backend.setting.bank.destroy');

    Route::resource('/banner', BannerController::class, ['as' => 'backend']);
});

/* ========================================================================================= */

/* ========================================================================================= */
/* BACKEND - DONATUR */
/* ========================================================================================= */

Route::group([
    'middleware' => ['auth', 'role:donatur']
], function () {
});

/* ========================================================================================= */

/* ========================================================================================= */
/* BACKEND - ADMIN, DONATUR */
/* ========================================================================================= */

Route::group([
    'middleware' => ['auth', 'role:admin,donatur']
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');
    Route::resource('/campaign', FrontendCampaignController::class, ['as' => 'frontend'])
        ->only('index', 'create', 'edit'); // frontend.campaign.index
    Route::get('/campaign/data', [BackendCampaignController::class, 'data'])->name('backend.campaign.data');
    Route::get('/user/profile', [UserProfileInformationController::class, 'show'])->name('backend.profile.show');
    Route::get('/donation/{id}/create', [DonationController::class, 'create'])->name('frontend.donation.create');
    Route::post('/donation/{id}/checkout', [DonationController::class, 'checkout'])->name('frontend.donation.checkout');
    Route::get('/donation/{id}/payment/{order_number}', [DonationController::class, 'payment'])->name('frontend.donation.payment');
    Route::post('/donation/callback_payment', [DonationController::class, 'callback_payment'])->name('frontend.donation.callback_payment');
});

/* ========================================================================================= */










// Route::group([
//     'middleware' => ['auth', 'role:admin,donatur']
// ], function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//     Route::get('/user/profile', [UserProfileInformationController::class, 'show'])->name('profile.show');
//     Route::delete('/user/bank/{id}', [UserProfileInformationController::class, 'bank_destroy'])->name('profile.bank.destroy');

//     // Create Campaign
//     Route::get('/campaigns', [CampaignsController::class, 'index'])->name('frontend.campaign.index');

//     Route::group([
//         'middleware' => ['auth', 'role:admin'],
//         'prefix' => 'admin'
//     ], function () {
//         // Master
//         Route::resource('/category', CategoryController::class); // Untuk route dengan resource, Controller tidak boleh berbentuk array
//         Route::resource('/bank', BankController::class); // Untuk route dengan resource, Controller tidak boleh berbentuk array
//         Route::get('/campaign/data', [CampaignController::class, 'data'])->name('campaign.data');
//         Route::get('/campaign/detail/{id}', [CampaignController::class, 'detail'])->name('campaign.detail');
//         Route::resource('/campaign', CampaignController::class);
//         Route::get('/admin/contact/data', [BackendContactController::class, 'data'])->name('admin.contact.data');
//         Route::resource('/admin/contact', BackendContactController::class);
//         Route::get('/admin/subscriber/data', [SubscriberController::class, 'data'])->name('admin.subscriber.data');
//         // Route::resource('/admin/subscriber', SubscriberController::class);
//         Route::resource('/admin/subscriber', SubscriberController::class, ['as' => 'admin']); // admin.subscriber.index
//         Route::resource('/donatur', DonaturController::class);

//         // Pengaturan
//         Route::resource('/banner', BannerController::class);
//         Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
//         Route::put('/setting/{setting}', [SettingController::class, 'update'])->name('setting.update');
//         Route::delete('/setting/{setting}/bank/{id}', [SettingController::class, 'bank_destroy'])->name('setting.bank.destroy');

//         // Create Donation
//         Route::get('/donation/{id}/create', [DonationController::class, 'create'])->name('frontend.donation.create');
//         Route::post('/donation/{id}/checkout', [DonationController::class, 'checkout'])->name('frontend.donation.checkout');
//         Route::get('/donation/{id}/payment/{order_number}', [DonationController::class, 'payment'])->name('frontend.donation.payment');
//         Route::post('/donation/callback_payment', [DonationController::class, 'callback_payment'])->name('frontend.donation.callback_payment');
//     });

//     Route::group([
//         'middleware' => ['auth', 'role:donatur']
//     ], function () {
//     });
// });
