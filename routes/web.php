<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\{
    BankController,
    BannerController,
    CampaignController as BackendCampaignController,
    CashoutController,
    CategoryController,
    ContactController as BackendContactController,
    DashboardController,
    DonationController as BackendDonationController,
    DonaturController,
    NewsController as BackendNewsController,
    ReportController,
    SettingController,
    SubscriberController,
    UserProfileInformationController,
};

use App\Http\Controllers\Frontend\{
    AboutController,
    CampaignController as FrontendCampaignController,
    ContactController as FrontendContactController,
    DonationController as FrontendDonationController,
    HomeController as FrontendHomeController,
    NewsController as FrontendNewsController,
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

Route::get('/', [FrontendHomeController::class, 'index'])->name('frontend.home.index');
Route::get('/about', [AboutController::class, 'index'])->name('frontend.about.index');
Route::get('/donation', [FrontendDonationController::class, 'index'])->name('frontend.donation.index');
Route::get('/donation/{id}', [FrontendDonationController::class, 'detail'])->name('frontend.donation.detail');
Route::get('/news', [FrontendNewsController::class, 'index'])->name('frontend.news.index');
Route::get('/news/{id}', [FrontendNewsController::class, 'show'])->name('frontend.news.show');
Route::get('/contact', [FrontendContactController::class, 'index'])->name('frontend.contact.index');
Route::post('/contact', [FrontendContactController::class, 'store'])->name('frontend.contact.store');
Route::post('/subscriber', [FrontendHomeController::class, 'subscriber'])->name('frontend.subscriber.store');
/* ========================================================================================= */

/* ========================================================================================= */
/* BACKEND - ADMIN, DONATUR */
/* ========================================================================================= */
Route::group([
    'middleware' => ['auth', 'role:admin,donatur']
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');
    Route::resource('/campaigns', FrontendCampaignController::class, ['as' => 'frontend']); // frontend.campaign.index
    Route::resource('/campaign', BackendCampaignController::class, ['as' => 'backend'])->only('store', 'update');
    Route::get('/campaign/data', [BackendCampaignController::class, 'data'])->name('backend.campaign.data');
    Route::get('/user/profile', [UserProfileInformationController::class, 'show'])->name('backend.profile.show');
    Route::delete('/user/bank/{id}', [UserProfileInformationController::class, 'bank_destroy'])->name('backend.profile.bank.destroy');
    Route::get('/donation/{id}/create', [FrontendDonationController::class, 'create'])->name('frontend.donation.create');
    Route::post('/donation/{id}/checkout', [FrontendDonationController::class, 'checkout'])->name('frontend.donation.checkout');
    Route::get('/donation/{id}/payment/{order_number}', [FrontendDonationController::class, 'payment'])->name('frontend.donation.payment');
    Route::get('/donation/{id}/payment_confirm/{order_number}', [FrontendDonationController::class, 'payment_confirm'])->name('frontend.donation.payment_confirm');
});
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
    Route::resource('/campaign', BackendCampaignController::class, ['as' => 'backend'])->except('store', 'update');
    Route::get('/campaign/detail/{id}', [BackendCampaignController::class, 'detail'])->name('backend.campaign.detail');
    Route::put('/campaign/{id}/update_status', [BackendCampaignController::class, 'update_status'])->name('backend.campaign.update_status');
    Route::get('/campaign/{id}/cashout', [BackendCampaignController::class, 'cashout'])->name('backend.campaign.cashout');
    Route::post('/campaign/{id}/cashout', [BackendCampaignController::class, 'cashout_store'])->name('backend.campaign.cashout.store');
    Route::get('/news/data', [BackendNewsController::class, 'data'])->name('backend.news.data');
    Route::resource('/news', BackendNewsController::class, ['as' => 'backend']);

    // Referensi
    Route::get('/donatur/data', [DonaturController::class, 'data'])->name('backend.donatur.data');
    Route::resource('/donatur', DonaturController::class, ['as' => 'backend']);
    Route::get('/donation/data', [BackendDonationController::class, 'data'])->name('backend.donation.data');
    Route::resource('/donation', BackendDonationController::class, ['as' => 'backend']);
    Route::get('/cashout/data', [CashoutController::class, 'data'])->name('backend.cashout.data');
    Route::resource('/cashout', CashoutController::class, ['as' => 'backend']);
    Route::get('/contact/data', [BackendContactController::class, 'data'])->name('backend.contact.data');
    Route::resource('/contact', BackendContactController::class, ['as' => 'backend']);
    Route::get('/subscriber/data', [SubscriberController::class, 'data'])->name('backend.subscriber.data');
    Route::resource('/subscriber', SubscriberController::class, ['as' => 'backend']);

    // Report
    Route::get('/report', [ReportController::class, 'index'])->name('backend.report.index');
    Route::get('/report/data/{start}/{end}', [ReportController::class, 'data'])->name('backend.report.data');
    Route::get('/report/pdf/{start}/{end}', [ReportController::class, 'export_pdf'])->name('backend.report.export_pdf');
    Route::get('/report/excel/{start}/{end}', [ReportController::class, 'export_excel'])->name('backend.report.export_excel');

    // Pengaturan
    Route::resource('/banner', BannerController::class, ['as' => 'backend']);
    Route::get('/setting', [SettingController::class, 'index'])->name('backend.setting.index');
    Route::put('/setting/{setting}', [SettingController::class, 'update'])->name('backend.setting.update');
    Route::delete('/setting/{setting}/bank/{id}', [SettingController::class, 'bank_destroy'])->name('backend.setting.bank.destroy');
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

// Route::get('/testemail', [BackendDonationController::class, 'payment_donation_confirm']);
// Route::get('/testemail', function () {
//     return view('emails.payment_donation_confirm');
// });
