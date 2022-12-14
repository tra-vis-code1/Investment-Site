<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\Payments\VerifyPaymentController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//Register
Route::get('/register', [PageController::class, 'register'])->name('register.show');
Route::post('/register', [LoginController::class, 'register'])->name('register');

//verify user
Route::get('verification', [LoginController::class, 'verifyUser']);

//Login
Route::get('/login', [PageController::class, 'login'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login');


//Logged in user session middleware
Route::middleware('auth')->group(function() {

    //Dashboard
    Route::get('/', [PageController::class, 'home'])->name('home');

    //Logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    //Go To Credit Wallet Page
    Route::get('/credit-wallet', [PageController::class, 'creditWallet'])->name('wallet.credit');

    //Get Notifications for user
    Route::get('get-notifications', [NotificationController::class, 'notifications']);

    Route::get('notification/read/{id}', [NotificationController::class, 'readNotification']);

    //*******************PAYMENTS RELATED ROUTES*****************\\

        //****Verify Payments **\\
        Route::get('verify-payment/{reference}', [VerifyPaymentController::class, 'verifyPayment']);

    //**********************END*************************\\
});
