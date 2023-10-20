<?php

namespace Modules\Place\app\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Place\app\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        // Tenant route (web)
        if (file_exists($tenant_web_route = module_path('Place', '/routes/web.tenant.php'))) {
            Route::middleware('web')->namespace($this->moduleNamespace)->group($tenant_web_route);
        }

        // Central domains route (web)
        $central_domains = config('tenancy.central_domains');
        $web_route = module_path('Place', '/routes/web.php');

        if ($central_domains) {
            foreach ($central_domains as $domain) {
                Route::middleware('web')->domain($domain)->namespace($this->moduleNamespace)->group($web_route);
            }
        } else {
            Route::middleware('web')->namespace($this->moduleNamespace)->group($web_route);
        }
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        // Tenant route (api)
        if (file_exists($tenant_api_route = module_path('Place', '/routes/api.tenant.php'))) {
            Route::prefix('api')->middleware('api')->namespace($this->moduleNamespace)->group($tenant_api_route);
        }

        // Central domains route (api)
        $central_domains = config('tenancy.central_domains');
        $api_route = module_path('Place', '/routes/api.php');

        if ($central_domains) {
            foreach ($central_domains as $domain) {
                Route::prefix('api')->middleware('api')->domain($domain)->namespace($this->moduleNamespace)->group($api_route);
            }
        } else {
            Route::prefix('api')->middleware('api')->namespace($this->moduleNamespace)->group($api_route);
        }
    }
}
