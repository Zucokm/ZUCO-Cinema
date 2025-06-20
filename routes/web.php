<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\CuschooseController;
use App\Http\Controllers\CusmovieController;
use App\Http\Controllers\CusplacesController;
use App\Http\Controllers\CusscheduleController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\RegisteredAdminController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SeatTypeController;
use App\Http\Controllers\SessionController;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Movie;
use App\Models\Place;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// 🌐 Public Home Page
Route::get('/', function () {
    $movies = Movie::all();
    $places = Place::all();
    $user = Auth::user();
    return view('welcome', [
        'movies' => $movies,
        'places' => $places,
        'user' => $user,
    ]);
});


Route::get('/alogin', [AdminLoginController::class, 'create']);
Route::post('/alogin', [AdminLoginController::class, 'store']);
Route::get('/aregister', [RegisteredAdminController::class, 'create']);
    Route::post('/aregister', [RegisteredAdminController::class, 'store']);


Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
        $totalMovies = Movie::count();
        $totalUsers = User::count();
        $totalBookings = Booking::count();
        $totalSchedules = Schedule::count();
        $totalAdmins = Admin::count();
        return view('dashboard',[
            'totalMovies' => $totalMovies,
            'totalUsers' => $totalUsers,
            'totalBookings' => $totalBookings,
            'totalSchedules' => $totalSchedules,
            'totalAdmins' => $totalAdmins,
        ]);
    });

    Route::put('/adminprofile/update', [RegisteredAdminController::class, 'update'])->name('adminprofile.update');
    Route::delete('/adminprofile/delete', [RegisteredAdminController::class, 'destroy'])->name('adminprofile.delete');

    Route::delete('/alogout', [AdminLoginController::class, 'destroy']);

    // 🎬 Admin movie/place/cinema management (protect if needed)
    Route::resource('movies', MovieController::class);
    Route::resource('cinemas', CinemaController::class);
    Route::resource('places', PlaceController::class);
    Route::get('/cinemas/{place}/create', [CinemaController::class, 'create']);
    Route::resource('seattypes', SeatTypeController::class);
    Route::post('/seattypes/autogenerate', [SeatTypeController::class, 'autoGenerate'])->name('seattypes.autogenerate');
    Route::resource('schedules', ScheduleController::class);
    Route::get('/schedules/{place}/create', [ScheduleController::class, 'create']);
});


Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);



Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::post('/booking', [BookingController::class, 'store'])->middleware('auth');
Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');


Route::resource('cusmovies', CusmovieController::class);
Route::resource('cusplaces', CusplacesController::class);
Route::resource('cusschedules', CusscheduleController::class);
Route::resource('cuschooses', CuschooseController::class);
Route::post('/seat/confirm', [BookingController::class, 'confirm'])->name('seat.confirm');
Route::resource('bookings', BookingController::class)->middleware('auth'); 

Route::get('/choosecinema/{id}', [CusplacesController::class, 'choose'])->name('choosecinema');



Route::middleware(['auth'])->group(function () {
    Route::put('/profile/update', [RegisteredUserController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [RegisteredUserController::class, 'destroy'])->name('profile.delete');
});

