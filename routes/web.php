<?php

use App\Http\Controllers\DdosWizard;
use App\Http\Controllers\SwitchLocaleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ViewFileController;
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

Route::get('locale/{locale}', SwitchLocaleController::class)->name('locale.switch');

Route::group([
    'prefix' => LocaleManager::routePrefixFromRequest(),
], function () {
    /* Pages */
    Route::get('/', [PageController::class, 'index'])->name('index');
    Route::get('/ddos', [PageController::class, 'ddos'])->name('pages.ddos');
    Route::get('/news-channels', [PageController::class, 'newsChannels'])->name('pages.news-channels');
    Route::get('/no-connection', [PageController::class, 'noConnection'])->name('pages.no-connection');

    /* DDoS Wizard */
//    Route::get('/ddos/intro', [DdosWizard::class, 'intro'])->name('ddos.intro');
//    Route::get('/ddos/select-device', [DdosWizard::class, 'selectDevice'])->name('ddos.select-device');
//    Route::get('/ddos/software', [DdosWizard::class, 'software'])->name('ddos.software');
});

Route::get('/view-file', ViewFileController::class)->name('view.file');
