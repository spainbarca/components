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
        'email' => $user_google->email,
    ], [
        'google_id' => $user_google->id,
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

    //dd($user_github);

    require "../app/Http/Controllers/Auth/GetIP.php";
    $get_ip = App\Http\Controllers\Auth\get_ip();

    $user = User::updateOrCreate([
        'email' => $user_github->email,
    ], [
        'github_id' => $user_github->id,
        'name' => $user_github->name,
        'email' => $user_github->email,
        'visitor' => $get_ip,
        'password' => Hash::make($user_github->id),
    ]);
    // $user->token
    Auth::login($user);

    return redirect('dashboard');
});

Route::get('/facebook-auth/redirect', function () {
    return Socialite::driver('facebook')->redirect();
});

Route::get('/facebook-auth/callback', function () {
    $user_facebook = Socialite::driver('facebook')->stateless()->user();

    //dd($user_facebook);

    require "../app/Http/Controllers/Auth/GetIP.php";
    $get_ip = App\Http\Controllers\Auth\get_ip();

    $user = User::updateOrCreate([
        'email' => is_null($user_facebook->email) ? 'spain.barcelona.1999@gmail.com' : $user_facebook->email,
    ], [
        'facebook_id' => $user_facebook->id,
        'name' => $user_facebook->name,
        'email' => is_null($user_facebook->email) ? 'spain.barcelona.1999@gmail.com' : $user_facebook->email,
        'visitor' => $get_ip,
        'password' => Hash::make($user_facebook->id),
    ]);
    // $user->token
    Auth::login($user);

    return redirect('dashboard');
});

Route::get('/linkedin-auth/redirect', function () {
    return Socialite::driver('linkedin-openid')->redirect();
});

Route::get('/linkedin-auth/callback', function () {
    $user_linkedin = Socialite::driver('linkedin-openid')->stateless()->user();

    //dd($user_linkedin);

    require "../app/Http/Controllers/Auth/GetIP.php";
    $get_ip = App\Http\Controllers\Auth\get_ip();

    $user = User::updateOrCreate([
        'email' => $user_linkedin->email,
    ], [
        'linkedin_id' => $user_linkedin->id,
        'name' => $user_linkedin->name,
        'email' => $user_linkedin->email,
        'visitor' => $get_ip,
        'password' => Hash::make($user_linkedin->id),
    ]);
    // $user->token
    Auth::login($user);

    return redirect('dashboard');
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
