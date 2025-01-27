<?php

use App\Models\Cart;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


//delete a cart items in database for a particular guest user everyweek;
Artisan::command('delete:record', function () {
    Cart::where('session_id', session('user_session'))->delete();
})->purpose('delete cart record fo a user')->everySecond();;


// Schedule::call(function() {
//     Cart::where('session_id', session('user_session'))->delete();
// })->everySecond();