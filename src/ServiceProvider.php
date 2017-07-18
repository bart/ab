<?php

namespace Bart\Ab;

use Illuminate\Support\Facades\Blade;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__.'/config/ab.php' => config_path('ab.php')]);

        Blade::directive('test', function($expression)
        {
            return "<?php if({$expression} === app('ab')->getCurrentTest()): ?>";
        });

        Blade::directive('endtest', function()
        {
            return '<?php endif; ?>';
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Ab::class, function () {
            return new Ab();
        });

        $this->app->alias(Ab::class, 'ab');
    }
}
