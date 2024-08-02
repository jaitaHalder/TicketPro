<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Admin\BusStopController;
use App\Http\Controllers\Admin\ContactFormController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

// HomeController
Route::get("/", [HomeController::class, "index"])->name("home");
Route::get("/privacy-policy", [HomeController::class, "privacyPolicy"])->name("privacy_policy");
Route::get("/about-us", [HomeController::class, "aboutUs"])->name("about_us");
Route::get("/contact-us", [HomeController::class, "contactUs"])->name("contact_us");
Route::post("/contact-form-submit", [HomeController::class, "contactFormSubmit"])->name("contact_form_submit");


// AuthController
Route::get("admin/login", [AuthController::class, "index"])->name("admin.auth.index");
Route::post("admin/login", [AuthController::class, "login"])->name("admin.auth.login");

// Admin Group
Route::group(["middleware" => "auth.admin", "prefix" => "admin", "as" => "admin."], function () {
    // AuthController
    Route::get("logout", [AuthController::class, "logout"])->name("auth.logout");
    Route::get("profile", [AuthController::class, "profile"])->name("auth.profile");
    Route::put("profile", [AuthController::class, "profileUpdate"])->name("auth.profile");

    // DashboardController
    Route::get("dashboard", [DashboardController::class, "index"])->name("dashboard.index");

    // ProductController
    Route::resource("buses", BusController::class);
    Route::resource("bus-stops", BusStopController::class);

    // RouteController
    Route::resource("routes", RouteController::class);

    // TripController
    Route::resource("trips", TripController::class);

    // TicketController
    Route::get("tickets/trashes", [TicketController::class, "trashes"])->name("tickets.trashes");
    Route::get("tickets/{ticket_id}/restore", [TicketController::class, "restore"])->name("tickets.restore");
    Route::delete("tickets/{ticket_id}/force-delete", [TicketController::class, "forceDelete"])->name("tickets.force_delete");

    Route::get("tickets/{ticket_id}/print", [TicketController::class, "print"])->name("tickets.print");
    Route::resource("tickets", TicketController::class)->except(["edit"]);

    // SettingsController
    Route::get("settings", [SettingController::class, "index"])->name("settings.index");
    Route::put("settings", [SettingController::class, "update"])->name("settings.update");

    // ContactForm
    Route::get("contact-forms", [ContactFormController::class, "index"])->name("contact_forms.index");
    Route::delete("contact-forms/{contact_form}", [ContactFormController::class, "destroy"])->name("contact_forms.destroy");
});


// UserController
Route::get("user/signup", [UserController::class, "signup"])->name("user.signup");
Route::post("user/signup", [UserController::class, "signupAction"])->name("user.signup");
Route::get("user/login", [UserController::class, "login"])->name("user.login");
Route::post("user/login", [UserController::class, "loginAction"])->name("user.login");

// User Group
Route::group(["middleware" => "auth", "prefix" => "user", "as" => "user."], function() {
    // UserController
    Route::get('/email-verification/{token?}', [UserController::class, 'emailVerification'])->name('email_verification');

    Route::get('/seat-book', [UserController::class, 'sitBook'])->name('seat_book');
    Route::post('/seat-book', [UserController::class, 'sitBookAction'])->name('seat_book');

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/bookings', [UserController::class, 'bookings'])->name('bookings');
    Route::get('/bookings/{ticket_id}/print', [UserController::class, 'print'])->name('bookings.print');

    Route::get('/change-password', [UserController::class, 'changePassword'])->name('change_password');
    Route::put('/change-password', [UserController::class, 'changePasswordAction'])->name('change_password');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});
