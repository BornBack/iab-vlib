<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\VirtualLibraryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, "index"])->name("user.home");

Route::middleware("auth")->group(function (){
    Route::get('edit/profile', [HomeController::class, "editProfileIndex"])->name("user.edit.index");
    Route::post('edit/profile', [HomeController::class, "editProfile"])->name("user.edit");
    Route::post('user/changepassword', [HomeController::class, "changePassword"])->name("user.changepwd");
    Route::post("logout", [AuthController::class, "logout"])->name("user.logout");
});

Route::middleware("guest")->group(function (){
    Route::view("login", "user.auth.login")->name("user.login.index");
    Route::post("login", [AuthController::class, "login"])->name("user.login");
    Route::view("register", "user.auth.register")->name("user.register.index");
    Route::post("register", [AuthController::class, "register"])->name("user.register");
});

Route::middleware(['admin.auth'])->prefix("admin")->group(function () {
    Route::get('dashboard', [DashboardController::class, "index"])->name("admin.dashboard");
    Route::view('change-password', 'admin.change-password')->name("admin.changepwd.index");
    Route::post('change-password', [AdminAuthController::class, 'changePassword'])->name("admin.changepwd");
    Route::get('vlib', [VirtualLibraryController::class, "index"])->name("admin.vlib.index");
    Route::view('users', "admin.users")->name("admin.users.index");
    Route::get('settings', [SettingsController::class, "index"])->name("admin.settings.index");
    Route::post('settings', [SettingsController::class, "update"])->name("admin.settings.update");
    Route::post('logout', [AdminAuthController::class, "logout"])->name("admin.logout");
});

Route::middleware(['admin.guest'])->prefix("admin")->group(function(){
    Route::view('login', 'admin.auth.login')->name("admin.login.index");
    Route::post('login', [AdminAuthController::class, "login"])->name("admin.login");
});

Route::get("artisan", function (){
    Artisan::call("cache:clear");
});