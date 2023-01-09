<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::post('/send-email', [EmailController::class, 'sendEmail']);
Route::get('test/email', function(){
  
	$send_mail = 'mianazan3@gmail.com';
  
    dispatch(new App\Jobs\SendEmailJob($send_mail));
  
    dd('send mail successfully !!');
});
require __DIR__.'/auth.php';
