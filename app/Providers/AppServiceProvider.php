<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Safety net for the Vercel deployment (see trustProxies() in bootstrap/app.php):
        // the platform always serves the site over https, so make sure every generated
        // URL uses https as well. Browsers refuse to load a http:// stylesheet/script
        // from a https page (mixed content), which is what broke the homepage layout.
        $onVercel = getenv('VERCEL') === '1' || ($_SERVER['VERCEL'] ?? null) === '1';

        if ($this->app->environment('production') && $onVercel) {
            URL::forceScheme('https');
        }

        config((['app.local' => 'id']));
        Carbon::setLocale('id');
    }
}
