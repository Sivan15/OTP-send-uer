<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', [UserController::class, 'index'])->middleware(['auth', 'role:admin'])->name('admin.index');
Route::get('/admin/create', [UserController::class, 'create'])->middleware(['auth', 'role:admin'])->name('admin.create');
Route::get('/admin/users', [UserController::class, 'index'])->middleware(['auth', 'role:admin'])->name('admin.index');
Route::post('/admin/store', [UserController::class, 'store'])->middleware(['auth', 'role:admin'])->name('admin.store');
Route::get('/admin/show', [UserController::class, 'show'])->middleware(['auth', 'role:admin'])->name('admin.show');
Route::get('/admin/edit/{id}', [UserController::class, 'edit'])->middleware(['auth', 'role:admin'])->name('admin.edit');
Route::put('/admin/update/{id}', [UserController::class, 'update'])->middleware(['auth', 'role:admin'])->name('admin.update');
Route::delete('/admin/delete/{user}', [UserController::class, 'destroy'])->middleware(['auth', 'role:admin'])->name('admin.destroy');

Route::get('/admin/{user}', [UserController::class, 'show'])->middleware(['auth', 'role:admin'])->name('admin.show');

// Route::get('/admin/show', [UserController::class, 'show'])->name('admin.show');

// web.php

// Route for displaying all users to admin
Route::get('/admin/users', [UserController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.index');

// Route for displaying all users to regular users
Route::get('/users', [UserController::class, 'show'])
    ->middleware('auth')
    ->name('users.index');


Route::post('/send-otp', [UserController::class, 'sendOtp'])->name('send.otp');
Route::post('/verify-otp', [UserController::class, 'verifyOtp'])->name('verify.otp');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');



// Route::get('/usercreate', function () {
//     return view('index');
// })->middleware(['auth', 'role:admin'])->name('admin.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
