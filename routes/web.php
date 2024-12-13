<?php

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\authentications\LoginController;
use App\Http\Controllers\Owner\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;

Route::get('/', function (Request $request) {
    $user = $request->user();
    if (!$user)
        return redirect()->route('login');
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else if ($user->role === 'owner') {
        return redirect()->route('owner.dashboard');
    }
});

//authentication routes
Route::group([
    'prefix' => 'auth',
    'middleware' => 'guest'
], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login-submit', [LoginController::class, 'login'])->name('login.submit');
    Route::get('/register', [LoginController::class, 'register'])->name('register');
    Route::get('/forgot-password', [LoginController::class, 'forgot_password'])->name('forget.password');
});

Route::group([
    'middleware' => 'auth'
], function () {

    //admin route
    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['is_admin'],
    ], function () {
        // Dashboard Route
        Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard');

        //branches routes
        Route::get('/branches', [BranchController::class, 'index'])->name('branches');
        Route::post('store', [BranchController::class, 'store'])->name('branches.store'); 

        //users table routes
        Route::get('/users', [UserController::class, 'index'])->name('users');
    });

    //owner routes
    Route::group([
        'prefix' => 'owner',
        'as' => 'owner.',
        'middleware' => ['is_owner'],
    ], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

});
