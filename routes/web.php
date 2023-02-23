<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\PageController;
use App\Http\Controllers\API\PaypalController;
use App\Http\Controllers\API\CfcampaignController;
use App\Http\Controllers\API\CfregisterController;
use App\Http\Controllers\API\CfpaypalController;
use App\Http\Controllers\API\CfpaymentController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\UserDashboardController;
use App\Http\Controllers\API\CfauthorController;

/*
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Export donations
Route::post('export', [PageController::class, 'export']);

// Custom login page
Route::post('signin', [PageController::class, 'checkLogin']);

// Get login state
Route::get('loginstate', [PageController::class, 'getLoginState']);

// Get login user id
Route::get('loginuserid', [PageController::class, 'getLoginUserId']);

// Get login user id
Route::get('loginusername', [PageController::class, 'getLoginUserName']);

// Get login user details
Route::get('loginuserdetails', [PageController::class, 'getLoginUserdetails']);

// Check unique email for checkout page registration
Route::get('checkuniquemail/{email}', [PageController::class, 'checkUniqueEmail']);

// Dashboard: Main site dashboard
Route::get('getuserdashboarddata', [UserDashboardController::class, 'index']);

// Dashboard: Donation single page
Route::get('/donation-details/{slug}', [UserDashboardController::class, 'donation_details']);

// Paypal
// Route::post('paypalpaymentprocess', [PaypalController::class, 'validate_form']);
Route::get('payment-status', [PaypalController::class, 'paypal_payment']);
Route::get('paypal-cancel', function () {
   return view('paypal-cancel');
});

/******************* START CROWDFUNDING ***********************/
// POST: Create individual campaign
Route::post('createcfcampaign', [CfcampaignController::class, 'create_cf_campaign']);

// Experiement: in progress
Route::post('cfregister', [CfregisterController::class, 'store']);

// Single CF campaign
// Route::get('fundraising/{id}', [CfcampaignController::class, 'show']);

// Submit join team form
Route::post('submit-join-team', [CfcampaignController::class, 'join_team_submit']);

// CF Dashboard
Route::get('getdashboarddata', [DashboardController::class, 'index']);

// Edit Individual campaign
Route::post('submit-edit-campaign', [CfcampaignController::class, 'edit']);

// Delete campaign
Route::post('delete-campaign', [CfcampaignController::class, 'delete']);

// Author profile
Route::get('fundraising/author/{id}', [CfauthorController::class, 'author_profile']);

// // One off payment process
// Route::post('cfPaymentProcess', [CfpaymentController::class, 'cfPaymentProcess']);
// Route::post('cfinsertdonation', [CfpaymentController::class, 'insertDonation']);

// Export donations
Route::post('cfdonationsexport', [CfpaymentController::class, 'cfdonationsexport']);

// Export donors
Route::post('cfdonorsexport', [CfpaymentController::class, 'cfdonorsexport']);

// Paypal
Route::get('fundraising/payment-status', [CfpaypalController::class, 'paypal_payment']);
/******************* END CROWDFUNDING ***********************/

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::get('{any}', function () {
    return view('layouts/app');
})->where('any', '.*');
