<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\LocaleManager;
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

Route::any('locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

Route::group([
    'prefix' => LocaleManager::routePrefixFromRequest(),
], function () {
    Route::get('/', [PageController::class, 'index']);
});
