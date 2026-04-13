<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Borrowing;

// =====================
// HALAMAN DEPAN
// =====================
Route::get('/', function () {
    return redirect()->route('login');
});

// =====================
// GUEST
// =====================
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);
});

// =====================
// LOGOUT
// =====================
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// =====================
// SEMUA USER LOGIN
// =====================
Route::middleware(['auth'])->group(function () {

    // PEMINJAMAN
    Route::resource('borrowings', BorrowingController::class);

    // 🔥 APPROVE PINJAM
    Route::put('/borrowings/{borrowing}/approve', 
        [BorrowingController::class, 'approve'])
        ->name('borrowings.approve');

    // 🔥 USER REQUEST RETURN
    Route::put('/borrowings/{borrowing}/request-return', 
        [BorrowingController::class, 'requestReturn'])
        ->name('borrowings.requestReturn');

    // 🔥 ADMIN APPROVE RETURN
    Route::put('/borrowings/{borrowing}/approve-return', 
        [BorrowingController::class, 'approveReturn'])
        ->name('borrowings.approveReturn');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =====================
// ROLE: ADMIN
// =====================
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin', function () {
        return view('admin.dashboard', [
            'users' => \App\Models\User::count(),
            'books' => \App\Models\Book::count(),
            'borrowings' => \App\Models\Borrowing::count(),
        ]);
    })->name('admin.dashboard');

    Route::resource('books', BookController::class);
    Route::resource('users', UserController::class);
});

// =====================
// ROLE: PEMINJAM
// =====================
Route::middleware(['auth', 'role:peminjam'])->group(function () {

    Route::get('/dashboard', function () {

        $userId = Auth::id();

        return view('users.dashboard', [
            'dipinjam' => Borrowing::where('user_id', $userId)->where('status','dipinjam')->count(),
            'pending' => Borrowing::where('user_id', $userId)->where('status','pending')->count(),
            'selesai' => Borrowing::where('user_id', $userId)->where('status','selesai')->count(),
            'latest' => Borrowing::with('book')->where('user_id', $userId)->latest()->take(5)->get(),
        ]);

    })->name('dashboard');

});