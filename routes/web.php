<?php

use App\Events\TestEvent;
use Illuminate\Support\Facades\Auth;
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
})->name('index');

Route::get('/emit/{message}', function ($message) {
    event(new TestEvent($message));
});

Route::get('/login/{id}', function ($id) {
    $user = Auth::loginUsingId($id);
    if ($user) {
        echo '<pre>';
        print_r($user->toArray());
        echo '登录成功';
        header("refresh:3;url=" . route('index'));
    } else {
        echo '登录失败';
    }
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});
