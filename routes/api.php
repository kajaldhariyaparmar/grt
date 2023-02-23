<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\EventsController;
use App\Http\Controllers\API\CampaignController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\PageController;
use App\Http\Controllers\API\CfpaymentController;
use App\Http\Controllers\API\CfcampaignController;
use App\Http\Controllers\API\Controller;
use App\Http\Controllers\API\QurbaniController;
use App\Http\Controllers\API\BlogController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Posts
Route::get('allposts', [PostController::class, 'index']);
Route::get('posts', [PostController::class, 'filterPosts']);
// Categories
Route::get('categories', [PostController::class, 'getCategories']);
// Route::get('posts', 'App\Http\Controllers\API\PostController@index');
Route::group(['prefix' => 'post'], function () {
    Route::post('add', [PostController::class, 'add']);
    Route::get('edit/{id}', [PostController::class, 'edit']);
    Route::post('update/{id}', [PostController::class, 'update']);
    Route::delete('delete/{id}', [PostController::class, 'delete']);
});

// Campaigns
Route::get('allcampaigns', [CampaignController::class, 'index']);
// Route::get('campaigns', [CampaignController::class, 'getCampaigns']);
Route::get('campaigns/{id}', [CampaignController::class, 'getCampaigns']);
Route::get('dropdowncampaigns', [CampaignController::class, 'getDropdownCampaigns']);
Route::get('slidecampaigns', [CampaignController::class, 'getSlideCampaigns']);
Route::get('admincost', [CampaignController::class, 'getAdminCost']);

// Projects
Route::get('projects', [CampaignController::class, 'getProjects']);

// Countries
Route::get('countries', [CampaignController::class, 'getCountries']);

// Home settings
Route::get('homesettings', [PageController::class, 'getHomesettingsdata']);

// Appeals
Route::get('appeals', [CampaignController::class, 'getAppeals']);
Route::get('quickappeals', [CampaignController::class, 'getQuickAppeals']);
Route::group(['prefix' => 'campaign'], function () {
    Route::get('campaign/{id}', [CampaignController::class, 'single']);
    Route::post('addtocart', [CampaignController::class, 'addtocart']);
});

// Stripe payment
Route::post('singlePaymentProcess', [PaymentController::class, 'singlePaymentProcess']);
Route::post('monthlyPaymentProcess', [PaymentController::class, 'monthlyPaymentProcess']);
Route::post('weeklyPaymentProcess', [PaymentController::class, 'weeklyPaymentProcess']);
Route::get('stripepublickey', [PaymentController::class, 'getStripepublickey']);
Route::post('fetch-payment-details',[PaymentController::class,'fetchDetails']);

// About
Route::get('about', [PageController::class, 'about']);

// Contact
Route::post('contact', [PageController::class, 'contact']);

// Events
Route::get('pastevents', [EventsController::class, 'getPastEvents']);
Route::get('upcomingevents', [EventsController::class, 'getUpcomingEvents']);
Route::get('event/{id}', [EventsController::class, 'single']);
Route::post('processevents', [EventsController::class, 'processevents']);
Route::post('eventPaymentProcess', [EventsController::class, 'eventPaymentProcess']);

// Qurbani Packs
Route::get('qurbanipacks', [QurbaniController::class, 'getPacks']);
Route::get('qurbanipack/{id}', [QurbaniController::class, 'getPackDetails']);

// Blogs
Route::get('blogs', [BlogController::class, 'getBlogs']);
Route::get('blog/{id}', [BlogController::class, 'getBlogDetails']);
/*********************** START CROWDFUNDING **************************/
// CF-appeals
Route::get('cfappeals', [CfcampaignController::class, 'getCfappeals']);

// Home
Route::get('fundraising', [CfcampaignController::class, 'index']);

// Single CF campaign
Route::get('fundraising/{id}', [CfcampaignController::class, 'show']);

Route::post('cfPaymentProcess', [CfpaymentController::class, 'cfPaymentProcess']);
Route::post('cfPaymentDataProcess', [CfpaymentController::class, 'cfPaymentDataProcess']);


/*********************** END CROWDFUNDING **************************/
