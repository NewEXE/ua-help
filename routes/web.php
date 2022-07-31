<?php

use App\Http\Controllers\DdosWizard;
use App\Http\Controllers\FileSharing;
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
], static function () {
    /* Pages */
    Route::get('/', [PageController::class, 'index'])->name('index');
    Route::get('/ddos', [PageController::class, 'ddos'])->name('pages.ddos');
    Route::get('/news-channels', [PageController::class, 'newsChannels'])->name('pages.news-channels');
    Route::get('/no-connection', [PageController::class, 'noConnection'])->name('pages.no-connection');
    Route::get('/vpn', [PageController::class, 'vpn'])->name('pages.vpn');

    /* DDoS Wizard */
    Route::get('/ddos/intro', [DdosWizard::class, 'intro'])->name('ddos.intro');
    Route::get('/ddos/select-device', [DdosWizard::class, 'selectDevice'])->name('ddos.select-device');
    Route::get('/ddos/software/{device}', [DdosWizard::class, 'software'])->name('ddos.software');
});

Route::get('/view-file', ViewFileController::class)->name('view.file');

/* File Sharing  */
Route::get('/f', [FileSharing::class, 'index'])->name('file-sharing.index');
Route::post('/f/upload', [FileSharing::class, 'upload'])->name('file-sharing.upload');
Route::get('/f/{fileSlug}', [FileSharing::class, 'download'])->name('file-sharing.download');
