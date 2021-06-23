<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Auth::routes();

Route::get('logout',function()
{
 Auth::logout();
 Session::flush();
 return redirect()->route('login');
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user/index', [App\Http\Controllers\User\UserController::class, 'index'])->name('user.index');

Route::get('/admin/index', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');//->middleware(['auth', 'admin'])on peut ajouter le middlerware pour sécuriser l'url de chaque controller

Route::get('/admin/categories/index', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('/admin/categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('/admin/categories/store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.categories.store');
Route::get('/admin/categories/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::patch('/admin/categories/update/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.categories.update');
Route::delete('/admin/categories/delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.categories.delete');

Route::get('/admin/posts/index', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('admin.posts.index');
Route::get('/admin/posts/create', [App\Http\Controllers\Admin\PostController::class, 'create'])->name('admin.posts.create');
Route::post('/admin/posts/store', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('admin.posts.store');
Route::get('/admin/posts/show/{id}', [App\Http\Controllers\Admin\PostController::class, 'show'])->name('admin.posts.show');
Route::put('/admin/posts/published/{id}', [App\Http\Controllers\Admin\PostController::class, 'published'])->name('admin.posts.published');
Route::get('/admin/posts/edit/{id}', [App\Http\Controllers\Admin\PostController::class, 'edit'])->name('admin.posts.edit');
Route::put('/admin/posts/update/{id}', [App\Http\Controllers\Admin\PostController::class, 'update'])->name('admin.posts.update');
Route::delete('/admin/posts/trashed/{id}', [App\Http\Controllers\Admin\PostController::class, 'trashed'])->name('admin.posts.trashed');

//----------------------------- tags routes ------------------------------
Route::get('/admin/tags/index', [App\Http\Controllers\Admin\TagController::class, 'index'])->name('admin.tags.index');
Route::get('/admin/tags/create', [App\Http\Controllers\Admin\TagController::class, 'create'])->name('admin.tags.create');
Route::post('/admin/tags/store', [App\Http\Controllers\Admin\TagController::class, 'store'])->name('admin.tags.store');
Route::get('/admin/tags/edit/{id}', [App\Http\Controllers\Admin\TagController::class, 'edit'])->name('admin.tags.edit');
Route::patch('/admin/tags/update/{id}', [App\Http\Controllers\Admin\TagController::class, 'update'])->name('admin.tags.update');
Route::delete('/admin/tags/delete/{id}', [App\Http\Controllers\Admin\TagController::class, 'destroy'])->name('admin.tags.delete');

//----------------------------- trash routes ------------------------------
Route::get('/admin/trash/index', [App\Http\Controllers\Admin\TrashController::class, 'index'])->name('admin.trash.index');
Route::get('/admin/trash/posts/restore/{id}', [App\Http\Controllers\Admin\TrashController::class, 'restore'])->name('admin.trash.posts.restore');
Route::delete('/admin/trash/posts/delete/{id}', [App\Http\Controllers\Admin\TrashController::class, 'delete'])->name('admin.trash.posts.delete');