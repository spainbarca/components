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

Route::get('/twitter-auth/redirect', function () {
    return Socialite::driver('twitter-oauth-2')->redirect();
});

Route::get('/twitter-auth/callback', function () {
    $user_twitter = Socialite::driver('twitter-oauth-2')->stateless()->user();

    //dd($user_twitter);

    require "../app/Http/Controllers/Auth/GetIP.php";
    $get_ip = App\Http\Controllers\Auth\get_ip();

    $user = User::updateOrCreate([
        'twitter_id' => $user_twitter->id,
    ], [
        'twitter_id' => $user_twitter->id,
        'name' => $user_twitter->name,
        'email' => $user_twitter->nickname,
        'visitor' => $get_ip,
        'password' => Hash::make($user_twitter->id),
    ]);
    // $user->token
    Auth::login($user);

    return redirect('dashboard');
});

Route::get('/slack-auth/redirect', function () {
    return Socialite::driver('slack')->redirect();
});

Route::get('/slack-auth/callback', function () {
    $user_slack = Socialite::driver('slack')->stateless()->user();

    //dd($user_slack);

    require "../app/Http/Controllers/Auth/GetIP.php";
    $get_ip = App\Http\Controllers\Auth\get_ip();

    $user = User::updateOrCreate([
        'email' => $user_slack->email,
    ], [
        'slack_id' => $user_slack->id,
        'name' => $user_slack->name,
        'email' => $user_slack->email,
        'visitor' => $get_ip,
        'password' => Hash::make($user_slack->id),
    ]);
    // $user->token
    Auth::login($user);

    return redirect('dashboard');
});

Route::get('/discord-auth/redirect', function () {
    return Socialite::driver('discord')->redirect();
});

Route::get('/discord-auth/callback', function () {
    $user_discord = Socialite::driver('discord')->stateless()->user();

    //dd($user_discord);

    require "../app/Http/Controllers/Auth/GetIP.php";
    $get_ip = App\Http\Controllers\Auth\get_ip();

    $user = User::updateOrCreate([
        'email' => $user_discord->email,
    ], [
        'discord_id' => $user_discord->id,
        'name' => $user_discord->name,
        'email' => $user_discord->email,
        'visitor' => $get_ip,
        'password' => Hash::make($user_discord->id),
    ]);
    // $user->token
    Auth::login($user);

    return redirect('dashboard');
});

Route::get('/microsoft-auth/redirect', function () {
    return Socialite::driver('microsoft')->redirect();
});

Route::get('/microsoft-auth/callback', function () {
    $user_microsoft = Socialite::driver('microsoft')->stateless()->user();

    //dd($user_microsoft);

    require "../app/Http/Controllers/Auth/GetIP.php";
    $get_ip = App\Http\Controllers\Auth\get_ip();

    $user = User::updateOrCreate([
        'email' => $user_microsoft->email,
    ], [
        'microsoft_id' => $user_microsoft->id,
        'name' => $user_microsoft->name,
        'email' => $user_microsoft->email,
        'visitor' => $get_ip,
        'password' => Hash::make($user_microsoft->id),
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
