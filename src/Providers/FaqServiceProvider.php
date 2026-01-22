<?php

namespace Juzaweb\Modules\Faq\Providers;

use Illuminate\Support\Facades\File;
use Juzaweb\Modules\Core\Facades\Menu;
use Juzaweb\Modules\Core\Providers\ServiceProvider;

class FaqServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        //

        $this->booted(
            function () {
                $this->registerMenus();
            }
        );
    }

    public function register(): void
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->app->register(RouteServiceProvider::class);
    }

    protected function registerMenus(): void
    {
        Menu::make('faqs', function () {
            return [
                'title' => __('faq::translation.faqs'),
                'icon' => 'fas fa-question-circle',
                'permissions' => 'faqs.index',
            ];
        });
    }

    protected function registerConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('faq.php'),
        ], 'faq-config');
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'faq');
    }

    protected function registerTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'faq');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../resources/lang');
    }

    protected function registerViews(): void
    {
        $viewPath = resource_path('views/modules/faq');

        $sourcePath = __DIR__ . '/../resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', 'faq-module-views']);

        $this->loadViewsFrom($sourcePath, 'faq');
    }
}
