<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UrlShortenerController;

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


// Route::post('/shorten', [UrlShortenerController::class, 'shorten']);
// Route::get('/s/{slug}', [UrlShortenerController::class, 'redirect']);


// Show form
Route::get('/', function () {
    return view('urls.create');
});

// Show all shortened URLs
Route::get('/urls', function () {
    return view('urls.list', ['urls' => \App\Models\ShortUrl::all()]);
});

// Handle form submission
Route::post('/shorten', [UrlShortenerController::class, 'shorten'])->name('shorten.url');

// Redirect short URL
Route::get('/s/{slug}', [UrlShortenerController::class, 'redirect'])->name('shortened.redirect');


Route::get('/shortened/{slug}', [UrlShortenerController::class, 'showShortenedUrl'])->name('shortened.show');
Route::get('/previous-urls', [UrlShortenerController::class, 'previousUrls'])->name('shortened.previous');
