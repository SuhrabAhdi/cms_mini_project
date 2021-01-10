<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::resource('/blog',BlogController::class)->except(['show']);
Route::get('filter/{category}',[BlogController::class,'filter'])->name("category.filter");
Route::get('/recycle',[BlogController::class,'trash'])->name('blog.trash');
Route::get('/recycle/{post}',[BlogController::class,'restore'])->name('blog.restore');
Route::get('/recycle-remove/{post}',[BlogController::class,'remove'])->name('blog.remove');
Route::get('profile/edit/{user}',[ProfileController::class,'edit'])->name('profile.edit');
Route::put('profile/update/{user}',[ProfileController::class,'update'])->name('profile.update');

Route::get('faker',function(){
    $faker = Faker\Factory::create();
$fake  = $faker->image;
    return $fake;
});

Route::get('blog/{blog}',[BlogController::class,'show'])->name('blog.show')->middleware('can:view',App\Models\Post::class);