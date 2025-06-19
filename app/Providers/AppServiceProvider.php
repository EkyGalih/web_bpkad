<?php

namespace App\Providers;

use App\Settings\WebsiteSettings;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
     * @return void
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        Blade::directive('activeKip', function ($expression) {
            return "<?php echo (request()->routeIs('ppid-kip') && request()->route('klasifikasi') === $expression) ? 'active' : ''; ?>";
        });

        View::share('settings', app(WebsiteSettings::class));
    }
}
