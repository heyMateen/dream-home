<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TransactionController;
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
    if ($user->role === 'superadmin') {
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
        Route::group([
            'prefix' => 'branches',
            'as' => 'branches.',
        ], function () {
            Route::get('/', [BranchController::class, 'index'])->name('view');
            Route::get('/create', [BranchController::class, 'show_create_view'])->name('create.view');
            Route::post('/store', [BranchController::class, 'store'])->name('store');
            Route::get('/update/{branch}', [BranchController::class, 'show_update_view'])->name('update.view');
            Route::post('/update/{branch_id}', [BranchController::class, 'update'])->name('update');
            Route::get('delete/{branch_id}', [BranchController::class, 'delete'])->name('delete');
        });

        //properties routes
        Route::group([
            'prefix' => 'properties',
            'as' => 'properties.',
        ], function () {
            Route::get('/', [PropertyController::class, 'index'])->name('view');
            Route::get('/create', [PropertyController::class, 'show_create_view'])->name('create.view');
            Route::post('/store', [PropertyController::class, 'store'])->name('store');
            Route::get('/update/{property}', [PropertyController::class, 'show_update_view'])->name('update.view');
            Route::post('/update/{property_id}', [PropertyController::class, 'update'])->name('update');
            Route::get('delete/{property_id}', [PropertyController::class, 'delete'])->name('delete');
        });

        //client management routes
        Route::group([
            'prefix' => 'clients',
            'as' => 'clients.',
        ], function () {
            Route::get('/', [ClientController::class, 'index'])->name('view');
            Route::get('/create', [ClientController::class, 'show_create_view'])->name('create.view');
            Route::post('/store', [ClientController::class, 'store'])->name('store');
            Route::get('/update/{client}', [ClientController::class, 'show_update_view'])->name('update.view');
            Route::post('/update/{client_id}', [ClientController::class, 'update'])->name('update');
            Route::get('delete/{client_id}', [ClientController::class, 'delete'])->name('delete');
        });

        //owner management routes
        Route::group([
            'prefix' => 'owners',
            'as' => 'owners.',
        ], function () {
            Route::get('/', [OwnerController::class, 'index'])->name('view');
            Route::get('/create', [OwnerController::class, 'show_create_view'])->name('create.view');
            Route::post('/store', [OwnerController::class, 'store'])->name('store');
            Route::get('/update/{owner}', [OwnerController::class, 'show_update_view'])->name('update.view');
            Route::post('/update/{owner_id}', [OwnerController::class, 'update'])->name('update');
            Route::get('delete/{owner_id}', [OwnerController::class, 'delete'])->name('delete');
        });

        //appointments  routes
        Route::group([
            'prefix' => 'appointments',
            'as' => 'appointments.',
        ], function () {
            Route::get('/', [AppointmentController::class, 'index'])->name('view');
            Route::get('/create', [AppointmentController::class, 'show_create_view'])->name('create.view');
            Route::post('/store', [AppointmentController::class, 'store'])->name('store');
            Route::get('/update/{appointment}', [AppointmentController::class, 'show_update_view'])->name('update.view');
            Route::post('/update/{appointment_id}', [AppointmentController::class, 'update'])->name('update');
            Route::get('delete/{appointment_id}', [AppointmentController::class, 'delete'])->name('delete');
        });

        //transsactions  routes
        Route::group([
            'prefix' => 'transactions',
            'as' => 'transactions.',
        ], function () {
            Route::get('/', [TransactionController::class, 'index'])->name('view');
            Route::get('/create', [TransactionController::class, 'show_create_view'])->name('create.view');
            Route::post('/store', [TransactionController::class, 'store'])->name('store');
            Route::get('/update/{transaction}', [TransactionController::class, 'show_update_view'])->name('update.view');
            Route::post('/update/{transaction_id}', [TransactionController::class, 'update'])->name('update');
            Route::get('delete/{transaction_id}', [TransactionController::class, 'delete'])->name('delete');
        });

        //settings  routes
        Route::group([
            'prefix' => 'settings',
            'as' => 'settings.',
        ], function () {
            Route::get('/', [SettingsController::class, 'index'])->name('view');
            Route::post('/store', [SettingsController::class, 'store'])->name('store');
        });

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
