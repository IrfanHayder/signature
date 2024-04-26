<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignaturePadController;
use \App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;


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

// Route::get('privacy-policy', [FrontendController::class, 'privacy_policy'])->name('privacy_policy');
// Route::get('terms-and-conditions', [FrontendController::class, 'terms_and_conditions'])->name('terms_and_conditions');
// Route::get('about-us', [FrontendController::class, 'about_us'])->name('page.about_us');
// Route::get('artisan', function () {
//     Artisan::call('optimize:clear');
// });
// require __DIR__ . '/redirection.php';
// require __DIR__ . '/custom.php';

// Route::post('contact', [ContactController::class, 'store']);
// Route::controller(FrontendController::class)->group(function () {
//     Route::get('sitemap.xml', 'sitemap');
//     Route::get('blog', 'blog')->name('page.blog');
//     Route::get('blog/{slug}', 'single_blog')->name('page.single_blog');
//     Route::get('{lang}/blog/{slug}', 'single_blog_other_language')
//         ->where(['lang' => '[a-z]{2}'])
//         ->name('single_blog_other_language');
//     Route::get('{slug}', 'native_language_tool')->name('native_language_tool');
//     Route::get('{lang}/{slug}', 'other_language_tool')
//         ->where(['lang' => '[a-z]{2}'])
//         ->name('other_language_tool');
  
Route::get('/', [SignaturePadController::class, 'index'])->name('home');

Route::post('/', [SignaturePadController::class, 'upload'])->name('signaturepad.upload');

//Route::get('index', [SignaturePadController::class, 'pdf']);


//Route::get('download-pdf', [SignaturePadController::class, 'pdf_save'])->name('download');



Route::get('list',[SignaturePadController::class, 'list'])->name('signature.list');

Route::get('signature_pdf',[SignaturePadController::class, 'signature_pdf'])->name('signature.pdf.list');




// Route::get('admin/hash/4321',[AdminController::class, 'index']);

Route::get('dashboard',[AdminController::class, 'dashboard']);



//Route::get('send/mail', [SignaturePadController::class, 'send_mail'])->name('send_mail');





    
// });