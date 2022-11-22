<?php

use App\Events\MessageNotification;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\User\UserController;
use App\Models\User;
use App\Notifications\NotifyUser;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Homepage route
Route::get('/', function () {
    return view('welcome');
});

/**
 * All authenticated route
 */
Auth::routes();

// Home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * Admin Access route.
 */
Route::prefix('admin')->as('admin.')
    ->middleware('auth', 'role:super-admin|admin')
    ->group(function () {
        //Dashboard route
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])
            ->name('dashboard');
        Route::get('/search', [DashboardController::class, 'dashboard'])
            ->name('search');

        //Multiple image route
        Route::get('/multiple', [DashboardController::class, 'multiple'])
            ->name('multiple');
        Route::post('/multiple', [DashboardController::class, 'uploadImage'])
            ->name('uploadImage');
        Route::get('/showMultiple', [DashboardController::class, 'showUploadImage'])
            ->name('showUploadImage');

        //import and export user data route
        Route::get('/export', [AdminController::class, 'export'])
            ->name('export');
        Route::post('/import', [AdminController::class, 'import'])
            ->name('import');
        Route::get('/downloadPdf', [AdminController::class, 'downloadPdf'])
            ->name('downloadPdf');
        Route::get('template', [AdminController::class, 'template'])
            ->name('template');

        //Who has fullright permission can access route
        Route::middleware('permission:fullRight')->group(function () {
            //Crude Route
            Route::get('/addUser', [AdminController::class, 'showRegisterForm'])
                ->name('addUser');
            Route::get('/delete/{id}', [AdminController::class, 'deleteUser'])
                ->name('delete');
            Route::get('/edit/{id}', [AdminController::class, 'editUser'])
                ->name('edit');
            Route::post('/addUser', [AdminController::class, 'storeUser'])
                ->name('storeUser');
            Route::post('/update', [AdminController::class, 'updateUser'])
                ->name('update');

            //Optimize and clear cache route
            Route::get('/optimize', function () {
                Artisan::call('optimize:clear');
                return redirect('admin/dashboard');
            })->name('optimize');
            Route::get('/clear-cache', function () {
                Artisan::call('cache:clear');
                return redirect('admin/dashboard');
            })->name('clear.cache');

            //Assign Role and permission route
            Route::get('/list', [AdminController::class, 'adminList'])
                ->name('list');
            Route::get('/addole', [AdminController::class, 'addRoleForm'])
                ->name('addRoleForm');
            Route::post('/addole', [AdminController::class, 'addRole'])
                ->name('addRole');
        });
    });

/**
 * Individual user route
 */
Route::prefix('user')->as('user.')->middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])
        ->name('profile');
    Route::get('/edit', [UserController::class, 'edit'])
        ->name('edit');
    Route::post('/edit', [UserController::class, 'update'])
        ->name('updateUser');
});

// social login route
Route::get('/google/redirect', [GoogleController::class, 'googleRedirect'])
    ->name('google.redirect');
Route::get('/google/callback', [GoogleController::class, 'googleCallback'])
    ->name('google.callback');

// queue route
Route::get('queue', [UserController::class, 'queue']);
Route::post('queue', [UserController::class, 'sendMail'])
    ->name('queue');

// cron job route
Route::get('/email', function () {
    $userEmails = User::find(8)->only('email');
    // dd($userEmails);
    $userEmails = User::select('email')->get();
    foreach ($userEmails as $userEmail) {
        return $userEmail;
    }
});

// horizon route
Route::get('/notify', function () {
    $data = User::find(11)->notify(new NotifyUser());

    return 'done';
});

// broadcasting route
Route::get('/event', function () {
    event(new MessageNotification('This is first broadcasting notification!'));
});
Route::get('/listen', function () {
    return view('listen');
});

// gate and policy route
Route::get('gate', [AdminController::class, 'gate'])->name('gate');

// cashier - stripe route
Route::get('/subscribe', [SubscriptionController::class, 'showSubscription']);
Route::post('/subscribe', [SubscriptionController::class, 'processSubscription']);

// welcome page only for subscribed users route
Route::get('/welcome', [SubscriptionController::class, 'showWelcome'])
    ->middleware('subscribed');

//for change the language route
Route::get('language/{lan}', [AdminController::class, 'languages'])
    ->name('language');

// for notification
Route::get('send', [HomeController::class, 'sendNotification']);
