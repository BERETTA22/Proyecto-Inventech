<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Blade;
use Illuminate\Auth\Events\Login;
use App\Listeners\RedirectAfterLogin;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use App\Http\Middleware\RoleRedirect;
use App\View\Components\ProfileInformationForm;
use App\View\Components\UpdatePasswordForm;
use App\View\Components\DeleteUserForm;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->router->aliasMiddleware('role.redirect', RoleRedirect::class);
        
        // Registrar componentes Blade
        Blade::component('profile-information-form', ProfileInformationForm::class);
        Blade::component('update-password-form', UpdatePasswordForm::class);
        Blade::component('delete-user-form', DeleteUserForm::class);
    }

    public function register()
    {
        //
    }
}