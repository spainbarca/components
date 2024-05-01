<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProfileController;
use Illuminate\Validation\Rules;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->stateless()->user();

    require "../app/Http/Controllers/Auth/GetIP.php";
    $get_ip = App\Http\Controllers\Auth\get_ip();

    $user = User::updateOrCreate([
        'google_id' => $user_google->id,
    ], [
        'name' => $user_google->name,
        'email' => $user_google->email,
        'visitor' => $get_ip,
        'password' => Hash::make($user_google->id),
    ]);
    // $user->token
    Auth::login($user);

    return redirect('dashboard');
});

Route::get('/github-auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/github-auth/callback', function () {
    $user_github = Socialite::driver('github')->stateless()->user();

    require "../app/Http/Controllers/Auth/GetIP.php";
    $get_ip = App\Http\Controllers\Auth\get_ip();

    $user = User::updateOrCreate([
        'github_id' => $user_github->id,
    ], [
        'name' => $user_github->name,
        'email' => $user_github->email,
        'visitor' => $get_ip,
        'password' => Hash::make($user_github->id),
    ]);
    // $user->token
    Auth::login($user);

    return redirect('dashboard');
    //dd($user);
    // $user->token
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
