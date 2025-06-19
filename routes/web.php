
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\Admin\FilmController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;

Route::redirect('/', '/backend/login');

// Login, Logout & Register
Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login');
Route::get('/register', [LoginController::class, 'register'])->name('backend.register');
Route::post('/register', [LoginController::class, 'storeRegister'])->name('backend.register.store');
Route::post('backend/login', [LoginController::class, 'authenticateBackend'])->name('backend.login');
Route::post('/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');

// Lupa Password & Reset Password
Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{email}', [LoginController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('password.update');

// Login Guest
Route::get('/guest/login', [LoginController::class, 'loginAsGuest'])->name('guest.login');

Route::get('backend/home', [HomeController::class, 'index'])->name('backend.home');
// Home page bisa diakses oleh login biasa dan tamu
Route::get('backend/home', [HomeController::class, 'index'])
    ->middleware('auth.guest')
    ->name('backend.home');

// Semua route dibawah wajib user login (admin/user/guest)
Route::middleware(['auth'])->group(function () {
    // Film routes
    Route::post('/backend/admin/films', [FilmController::class, 'store'])->name('films.store');
    Route::get('/backend/films', [FilmController::class, 'index'])->name('backend.admin.film.index');
    Route::delete('/backend/films/{id}', [FilmController::class, 'destroy'])->name('backend.admin.film.destroy');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('backend.user.destroy');


    // Review routes (dengan middleware auth sudah)
    Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
    
    // User resource
    Route::resource('user', UserController::class, ['as' => 'backend']);

    // Group middleware admin untuk backend admin khusus
    Route::middleware(['admin'])->prefix('backend')->group(function () {
        Route::get('/dashboard', [DashController::class, 'dashBackend'])->name('backend.dashboard');
        Route::get('/admin/films/create', [FilmController::class, 'filmBackend'])->name('backend.admin.film.create');
        Route::get('/admin/films/index', [FilmController::class, 'index'])->name('backend.admin.film.index');
        Route::get('/admin/films/edit', [FilmController::class, 'update'])->name('backend.admin.film.edit');
        Route::resource('films', FilmController::class);
    });
});

// Route umum tanpa auth
Route::get('/film/{id}', [FilmController::class, 'show'])->name('film.show');
Route::get('/search', [FilmController::class, 'searchForm'])->name('film.search.form');
Route::get('/search/results', [FilmController::class, 'search'])->name('film.search');
Route::get('/film', [HomeController::class, 'filter'])->name('film.filter');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');


