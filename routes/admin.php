<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\UserController;
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
Route::get('hash/{hash}', [AdminController::class, 'setCookie']);
Route::get('{login?}', [AdminController::class, 'index'])->middleware(['admin_access', 'guest'])->where('login', 'login')->name('login');
Route::post('login', [UserController::class, 'login'])->middleware(['admin_access', 'guest'])->where('login', 'login')->name('admin_login');
Route::middleware(['admin_access', 'auth'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('dashboard', 'dashboard')->name('admin.dashboard');
        // SETTING ROUTES
        Route::get('settings', 'settings')->name('dashboard.settings');
        Route::post('settings', 'update_settings')->name('dashboard.update.settings');
        Route::get('settings/delete', 'settings_delete')->name('setting.delete');
    });
    //Blog Routes
    Route::controller(BlogController::class)->prefix('blog')->group(function () {
        Route::get('trash', 'trash_list')->name('blog.trash_list');
        Route::get('permanent_destroy/{id}', 'blog_permanent_destroy')->name('blog.permanent_destroy');
        Route::get('restore/{id}', 'blog_restore')->name('blog.restore');
    });
    Route::resource('blog', BlogController::class);
    //Tool Routes
    Route::controller(ToolController::class)->prefix('tool')->group(function () {
        Route::get('trash', 'trash_list')->name('tool.trash_list');
        Route::get('permanent_destroy/{id}', 'tool_permanent_destroy')->name('tool.permanent_destroy');
        Route::get('restore/{id}', 'tool_restore')->name('tool.restore');
        Route::get('audit/{id}', 'tool_audit')->name('tool.audit');
        // GET AND SET CONTENT
        Route::get('download/content/{tool}', 'download')->name('content.download');
        Route::post('upload/content/{tool}', 'upload_tool_content')->name('content.upload');
    });
    Route::resource('tool', ToolController::class);
    //Media Routes
    Route::controller(MediaController::class)->prefix('media')->group(function () {
        Route::get('trash', 'trash_list')->name('media.trash_list');
        Route::get('permanent_destroy/{id}', 'media_permanent_destroy')->name('media.permanent_destroy');
        Route::get('restore/{id}', 'media_restore')->name('media.restore');
    });
    Route::resource('media', MediaController::class)->only(['create', 'store', 'destroy']);
    // User List Routes
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('trash', 'trash_list')->name('admin.trash_list');
        Route::get('permanent_destroy/{id}', 'user_permanent_destroy')->name('admin.user.permanent_destroy');
        Route::get('restore/{id}', 'user_restore')->name('admin.user.restore');
    });
    Route::resource('user', UserController::class);
    // CONTACT ROUTES
    Route::controller(ContactController::class)->prefix('contact')->group(function () {
        Route::get('trash', 'trash')->name('dashboard.contacts.trash');
        Route::get('restore/{id}', 'restore')->name('dashboard.contacts.restore');
    });
    Route::resource('contact', ContactController::class);
    Route::get('modals', [AdminController::class, 'modals'])->name('dashboard.components');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
    // USERS FEEDBACK ROUTES END
});
