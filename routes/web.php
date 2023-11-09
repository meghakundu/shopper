<?php

use Illuminate\Support\Facades\Route;
use App\Jobs\SendEmailJob;
use App\Console\Commands\dailyReset;
use App\Services\MedicalTrustService;
use App\Services\MedicalTrust\Resources\DentalResource;

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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    URL::forceScheme('https');
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/dental/{id}/records', function (string $id) {
        return new DentalResource(MedicalTrustService::findOrFail($id));
    });
    Route::get('/share-posts/{id}', function(){
     dispatch(new SendEmailJob());
    });
    Route::get('/show-profile/{id}', [App\Http\Controllers\userController::class, 'showProfile']);

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        Route::get('/orders', 'HomeController@showOrders')->name('home.orders');
        Route::get('/edit_status/{id}', 'HomeController@editOrders')->name('home.editOrders');
        Route::put('/update_status/{item}',[App\Http\Controllers\HomeController::class,'updateOrders'])->name('home.updateStatus');
        Route::get('/send-mail/{id}', [App\Http\Controllers\HomeController::class, 'sendMail']);
        Route::get('/send-invoice/{id}', [App\Http\Controllers\HomeController::class, 'sendMailWithPDF']);
        Route::put('/cancel_subscription/{item}',[App\Http\Controllers\HomeController::class,'cancelSubscription'])->name('home.cancelSubscribe');
        Route::get('/manage-transactions', 'HomeController@transactionList')->name('home.transactions');
        Route::get('/refund-transaction/{id}', 'HomeController@refundPayment')->name('home.refundPayment');
        Route::put('/update-transactions/{item}',[App\Http\Controllers\HomeController::class,'updateTransaction'])->name('home.updatePayment');
        Route::get('/stocks', 'HomeController@showStocks')->name('home.stocks');
        Route::get('/blogs', 'HomeController@showBlogs')->name('home.blogs');
        
    });
    
});
