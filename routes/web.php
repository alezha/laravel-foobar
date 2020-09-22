<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/auth-test', function () {

});

Route::get('/test', function () {
    $user = new User([
        'email' => 'test@example.com',
    ]);

    $user = User::firstOrCreate(
        ['id' => 1],
        [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => \Hash::make(bin2hex(random_bytes(8)))
        ],
    );

    $user->email = 'asdf';
    $user->email = 'ok...';
});
