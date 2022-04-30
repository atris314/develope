<?php

namespace App\Providers;


use App\Models\Contact;
use App\Models\Header;
use App\Models\Listmenu;
use App\Models\Portfolio;
use App\Models\Setting;
use App\Models\Widget;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Schema;
use mysql_xdevapi\Exception;
use phpDocumentor\Reflection\DocBlock\Tag;
use Illuminate\Auth\Access\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @param GateConstract $gate
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        view::share('headers',Header::orderBy('id','DESC')->first());
        view::share('settings',Setting::orderBy('id','DESC')->first());
        view::share('widgets',Widget::orderBy('id','DESC')->first());
        view::share('contacts',Contact::orderBy('id','DESC')->first());
        view::share('portfolios',Portfolio::orderBy('id','ASC')->get());
        view::share('lists',Listmenu::orderBy('created_at','ASC')->get());
    }
}
