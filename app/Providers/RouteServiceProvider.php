<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        // ROUTE ADMIN
        $this->mapPenggunaRoutes();
        $this->mapPostAdmin();
        $this->mapPagesAdmin();
        $this->mapMenuAdmin();
        $this->mapGaleryAdmin();
        $this->mapFaqAdmin();
        $this->mapToolsAdmin();
        $this->mapPpidKipAdmin();
        $this->mapSliderAdmin();
        $this->mapPegawaiAdmin();
        $this->mapBannerAdmin();

        // ROUTE OPERATOR
        $this->mapPostOperator();
        $this->mapPagesOperator();
        $this->mapGaleryOperator();
        $this->mapSliderOperator();
        $this->mapBannerOperator();
        $this->mapPpidKipOperator();
        $this->mapToolsOperator();
        $this->mapProfileOperator();

        // ROUTE CLIENT
        $this->mapWebRoutes();

        // ROUTE INVENTARIS
        $this->mapInventarisRoutes();
    }

    public function mapPostAdmin()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/post.php'));
    }

    public function mapPostOperator()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/operator/post.php'));
    }

    public function mapPagesAdmin()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/pages.php'));
    }

    public function mapPagesOperator()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/operator/pages.php'));
    }

    public function mapMenuAdmin()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/menu.php'));
    }

    public function mapGaleryAdmin()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/galery.php'));
    }

    public function mapGaleryOperator()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/operator/galery.php'));
    }

    public function mapAppsAdmin()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/apps.php'));
    }

    public function mapPenggunaRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/user.php'));
    }

    public function mapFaqAdmin()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/faq.php'));
    }

    public function mapToolsAdmin()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/tools.php'));
    }

    public function mapToolsOperator()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/operator/tools.php'));
    }

    public function mapPpidKipAdmin()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/ppid.php'));
    }

    public function mapPpidKipOperator()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/operator/ppid.php'));
    }

    public function mapSliderAdmin()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/slider.php'));
    }

    public function mapSliderOperator()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/operator/slider.php'));
    }

    public function mapPegawaiAdmin()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/pegawai.php'));
    }

    public function mapBannerAdmin()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/banner.php'));
    }

    public function mapBannerOperator()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/operator/banner.php'));
    }

    public function mapProfileOperator()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/operator/profile.php'));
    }

    public function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    public function mapInventarisRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/inventaris.php'));
    }

    public function mapApiRoutes()
    {
        Route::middleware('api')
            ->middleware('api')
            // ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
