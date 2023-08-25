<?php

use App\Http\Controllers\ChatMessages;
use App\Http\Controllers\DdosWizard;
use App\Http\Controllers\FileSharing;
use App\Http\Controllers\SwitchLocaleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ViewFileController;
use App\Http\Controllers\YoutubeUnsubscribeController;
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
    // Cover routes with locale prefix (/ua, /en etc)
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

    /* YouTube unsubscribe from non-ukrainian channels */
    Route::get('/yt', [YoutubeUnsubscribeController::class, 'index'])
        ->name(YoutubeUnsubscribeController::INDEX_PAGE_ROUTE);
    Route::get('/yt/auth', [YoutubeUnsubscribeController::class, 'auth'])
        ->name(YoutubeUnsubscribeController::AUTH_ROUTE);
    Route::get('/yt/auth-redirect', [YoutubeUnsubscribeController::class, 'authRedirect'])
        ->name(YoutubeUnsubscribeController::AUTH_REDIRECT_ROUTE);
    Route::post('/yt/unsubscribe', [YoutubeUnsubscribeController::class, 'unsubscribe'])
        ->name(YoutubeUnsubscribeController::AUTH_UNSUBSCRIBE_ROUTE);
});

Route::get('/view-file', ViewFileController::class)->name('view.file');

/* File Sharing  */
Route::get('/f', [FileSharing::class, 'index'])->name('file-sharing.index');
Route::post('/f/upload', [FileSharing::class, 'upload'])->name('file-sharing.upload');
Route::get('/f/{fileSlug}', [FileSharing::class, 'download'])->name('file-sharing.download');

/* Chat messages */
Route::get('/k', [ChatMessages::class, 'index'])->name('chat-messages.index');
Route::post('/k/create', [ChatMessages::class, 'create'])->name('chat-messages.create');
