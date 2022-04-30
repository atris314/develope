<?php

use App\Events\PostEvent;
use App\Http\Controllers\back\AboutController;
use App\Http\Controllers\back\AdminController;
use App\Http\Controllers\back\AdminUserController;
use App\Http\Controllers\back\CategoryController;
use App\Http\Controllers\back\CatorderController;
use App\Http\Controllers\back\CommentController;
use App\Http\Controllers\back\CouponController;
use App\Http\Controllers\back\CtaController;
use App\Http\Controllers\back\EmailController;
use App\Http\Controllers\back\PackController;
use App\Http\Controllers\back\PhotoController;
use App\Http\Controllers\back\PostController;
use App\Http\Controllers\back\PresentController;
use App\Http\Controllers\back\ProtranslateController;
use App\Http\Controllers\back\ServiceController;
use App\Http\Controllers\back\ThreadController;
use App\Http\Controllers\back\TicketController;
use App\Http\Controllers\front\ContactController;
use App\Http\Controllers\front\frontController;
use App\Http\Controllers\front\ProductController;
use App\Http\Controllers\front\ProductPurchaseController;
use App\Http\Controllers\front\ResidController;
use App\Http\Controllers\front\TeammateController;
use App\Http\Controllers\front\TeamticketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Trez\RayganSms\Facades\RayganSms;

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

//Route::get('/', function () {
//    return view('welcome');
//});


Auth::routes(['verify'=>true]);


Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');


//back route

Route::prefix('api')->group(function (){
   Route::get('products/{id}/{sort}',[App\Http\Controllers\back\ProductController::class,'apiGetSortedProduct']);
});

Route::prefix('admin')->middleware('AdminCheck')->group(function (){
    Route::get('/',[App\Http\Controllers\back\AdminController::class,'index'])->name('admin');
    Route::get('/users', [App\Http\Controllers\back\AdminUserController::class, 'index'])->name('back.users');
    Route::get('/users/create', [App\Http\Controllers\back\AdminUserController::class, 'create'])->name('back.users.create');
    Route::post('/users/store', [App\Http\Controllers\back\AdminUserController::class, 'store'])->name('back.users.store');
    Route::get('/users/edit/{user}', [App\Http\Controllers\back\AdminUserController::class,'edit'])->name('back.users.edit');
    Route::put('/users/update/{user}', [App\Http\Controllers\back\AdminUserController::class,'update'])->name('back.users.update');
    Route::get('/users/delete/{user}', [App\Http\Controllers\back\AdminUserController::class,'destroy'])->name('back.users.delete');
    Route::get('/users/status/{user}', [App\Http\Controllers\back\AdminUserController::class,'updatestatus'])->name('back.users.status');
    Route::get('/users/profile/{user}', [App\Http\Controllers\back\AdminUserController::class,'profile'])->name('back.user.profile');
    Route::get('/users-search', [App\Http\Controllers\back\AdminUserController::class, 'userSearch'])->name('userSearch');

});

Route::prefix('admin/headers')->middleware('AdminCheck')->group(function (){
    Route::get('/', [App\Http\Controllers\back\HeaderController::class, 'index'])->name('back.headers');
    Route::get('/create', [App\Http\Controllers\back\HeaderController::class, 'create'])->name('back.headers.create');
    Route::post('/store', [App\Http\Controllers\back\HeaderController::class, 'store'])->name('back.headers.store');
    Route::get('/edit/{header}', [App\Http\Controllers\back\HeaderController::class,'edit'])->name('back.headers.edit');
    Route::put('/update/{header}', [App\Http\Controllers\back\HeaderController::class,'update'])->name('back.headers.update');
    Route::get('/delete/{header}', [App\Http\Controllers\back\HeaderController::class,'destroy'])->name('back.headers.destroy');
});

Route::prefix('admin/settings')->middleware('AdminCheck')->group(function (){
    Route::get('/', [App\Http\Controllers\back\SettingController::class, 'index'])->name('back.settings');
    Route::get('/create', [App\Http\Controllers\back\SettingController::class, 'create'])->name('back.settings.create');
    Route::post('/store', [App\Http\Controllers\back\SettingController::class, 'store'])->name('back.settings.store');
    Route::get('/edit/{setting}', [App\Http\Controllers\back\SettingController::class,'edit'])->name('back.settings.edit');
    Route::put('/update/{setting}', [App\Http\Controllers\back\SettingController::class,'update'])->name('back.settings.update');
    Route::get('/delete/{setting}', [App\Http\Controllers\back\SettingController::class,'destroy'])->name('back.settings.destroy');
});


Route::prefix('admin/widgets')->middleware('AdminCheck')->group(function (){
    Route::get('/', [App\Http\Controllers\back\WidgetController::class, 'index'])->name('back.widgets');
    Route::get('/create', [App\Http\Controllers\back\WidgetController::class, 'create'])->name('back.widgets.create');
    Route::post('/store', [App\Http\Controllers\back\WidgetController::class, 'store'])->name('back.widgets.store');
    Route::get('/edit/{widget}', [App\Http\Controllers\back\WidgetController::class,'edit'])->name('back.widgets.edit');
    Route::put('/update/{widget}', [App\Http\Controllers\back\WidgetController::class,'update'])->name('back.widgets.update');
    Route::get('/delete/{widget}', [App\Http\Controllers\back\WidgetController::class,'destroy'])->name('back.widgets.destroy');
});

Route::prefix('admin/portfolios')->middleware('AdminCheck')->group(function (){
    Route::get('/', [App\Http\Controllers\back\PortfolioController::class, 'index'])->name('back.portfolios');
    Route::get('/create', [App\Http\Controllers\back\PortfolioController::class, 'create'])->name('back.portfolios.create');
    Route::post('/store', [App\Http\Controllers\back\PortfolioController::class, 'store'])->name('back.portfolios.store');
    Route::get('/edit/{portfolio}', [App\Http\Controllers\back\PortfolioController::class,'edit'])->name('back.portfolios.edit');
    Route::put('/update/{portfolio}', [App\Http\Controllers\back\PortfolioController::class,'update'])->name('back.portfolios.update');
    Route::get('/delete/{portfolio}', [App\Http\Controllers\back\PortfolioController::class,'destroy'])->name('back.portfolios.destroy');
});

Route::prefix('admin/contacts')->middleware('AdminCheck')->group(function (){
    Route::get('/', [App\Http\Controllers\back\ContactController::class, 'index'])->name('back.contacts');
    Route::get('/create', [App\Http\Controllers\back\ContactController::class, 'create'])->name('back.contacts.create');
    Route::post('/store', [App\Http\Controllers\back\ContactController::class, 'store'])->name('back.contacts.store');
    Route::get('/edit/{contact}', [App\Http\Controllers\back\ContactController::class,'edit'])->name('back.contacts.edit');
    Route::put('/update/{contact}', [App\Http\Controllers\back\ContactController::class,'update'])->name('back.contacts.update');
    Route::get('/delete/{contact}', [App\Http\Controllers\back\ContactController::class,'destroy'])->name('back.contacts.destroy');
});
Route::prefix('admin/lists')->middleware('AdminCheck')->group(function (){
    Route::get('/', [App\Http\Controllers\back\ListmenuController::class, 'index'])->name('back.lists');
    Route::get('/create', [App\Http\Controllers\back\ListmenuController::class, 'create'])->name('back.lists.create');
    Route::post('/store', [App\Http\Controllers\back\ListmenuController::class, 'store'])->name('back.lists.store');
    Route::get('/edit/{list}', [App\Http\Controllers\back\ListmenuController::class,'edit'])->name('back.lists.edit');
    Route::put('/update/{list}', [App\Http\Controllers\back\ListmenuController::class,'update'])->name('back.lists.update');
    Route::get('/delete/{list}', [App\Http\Controllers\back\ListmenuController::class,'destroy'])->name('back.lists.destroy');
});


Route::prefix('admin/photos')->middleware('AdminCheck')->group(function (){
    Route::get('/', [App\Http\Controllers\back\PhotoController::class, 'index'])->name('back.photos');
    Route::get('/create', [App\Http\Controllers\back\PhotoController::class, 'create'])->name('back.photos.create');
    Route::post('/store', [App\Http\Controllers\back\PhotoController::class, 'store'])->name('back.photos.store');
    Route::get('/edit/{photo}', [App\Http\Controllers\back\PhotoController::class,'edit'])->name('back.photos.edit');
    Route::put('/update/{photo}', [App\Http\Controllers\back\PhotoController::class,'update'])->name('back.photos.update');
    Route::get('/delete/{photo}', [App\Http\Controllers\back\PhotoController::class,'destroy'])->name('back.photos.destroy');
    Route::get('/status/{photo}', [App\Http\Controllers\back\PhotoController::class,'updatestatus'])->name('back.photos.status');
    Route::post('/upload/', [App\Http\Controllers\back\PhotoController::class,'upload'])->name('back.photos.upload');
    Route::delete('/delete/media', [App\Http\Controllers\back\PhotoController::class,'deleteAll'])->name('back.photos.delete.all');

});

//////////////////////////front-end routes////////////////////////////////

    Route::get('/', [App\Http\Controllers\front\HomeController::class, 'index'])->name('home');

    Route::get('/portfolio/{portfolio}', [App\Http\Controllers\front\PortfolioController::class, 'show'])->name('portfolio-detail');
    Route::get('/portfolio-all/', [App\Http\Controllers\front\PortfolioController::class, 'portfolioAll'])->name('portfolio-all');

