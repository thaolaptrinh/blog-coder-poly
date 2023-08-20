<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Admin\Settings\GeneralSetting;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/migrate-refresh-seed', function () {
    try {
        Artisan::call('migrate:fresh', ['--seed' => true]);
        return "Database has been refreshed and seeded!";
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
});


require __DIR__ . '/auth.php';



Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::controller(ProviderController::class)->group(function () {
    Route::get('/auth/{provider}/redirect', 'redirect')->name('provider.redirect');
    Route::get('/auth/{provider}/callback', 'callback')->name('provider.callback');
});


Route::middleware(['auth', 'verified', 'active'])->prefix('admin')->name('admin.')->group(function () {


    Route::get('/', HomeController::class)->name("home");

    Route::view('/profile', 'admin.profile.index')->name("profile.edit");

    Route::prefix('posts')->name('posts.')->group(function () {
        Route::view('/', 'admin.posts.index')->name("index");
        Route::view('/create', 'admin.posts.create')->name("create");
        Route::view('/edit/{post}', 'admin.posts.edit')->name("edit");
        Route::view('/create', 'admin.posts.create')->name("create");
        Route::view('/categories', 'admin.categories.index')->name("categories.index");
        Route::view('/tags', 'admin.tags.index')->name("tags.index");
    });


    Route::view('/settings', 'admin.settings.index')->name("settings");


    Route::group(['middleware' => ['role:administrator']], function () {
        Route::view('/users', 'admin.users.index')->name("users.index");
    });

    Route::any('{any}', function () {
        return notFound('admin.errors.404');
    })->where('any', '.*');
});



Route::middleware('blog.status')
    ->get('/search', [BlogController::class, 'search'])
    ->name('guest.search');

Route::middleware('blog.status', 'cacheResponse:600')->controller(BlogController::class)->name('guest.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/post/{slug}', 'post')->name('post');
    Route::get('/category/{slug}', 'category')->name('category');
    Route::get('/tag/{slug}', 'tag')->name('tag');
    Route::get('/{page}', 'page')->name('page');

    Route::any('{any}', function () {
        return notFound();
    })->where('any', 'guest.*');
});
