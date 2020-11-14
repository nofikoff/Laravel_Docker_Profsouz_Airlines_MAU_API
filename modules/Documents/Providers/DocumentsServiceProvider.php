<?php

namespace Modules\Documents\Providers;

use Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\View;
use Modules\Posts\Entities\Branch;
use Modules\Documents\Entities\Document;
use Modules\Documents\Observers\DocumentObserver;

class DocumentsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->registerComposers();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Document::observe(DocumentObserver::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        //$this->publishes([
        //    __DIR__.'/../Config/config.php' => config_path('documents.php'),
        //], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'documents'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        //$viewPath = resource_path('views/modules/documents');

        $sourcePath = __DIR__.'/../resources/views';

        //$this->publishes([
        //   $sourcePath => $viewPath
        //]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/documents';
        }, Config::get('view.paths')), [$sourcePath]), 'documents');
    }

    public function registerComposers()
    {
        View::composer('documents::components.categories', function (\Illuminate\View\View $view) {
            $categories = Branch::userRead()->get();
            $view->with('categories', $categories);
        });
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/documents');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'documents');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../resources/lang', 'documents');
        }
    }

    /**
     * Register an additional directory of factories.
     * @source https://github.com/sebastiaanluca/laravel-resource-flow/blob/develop/src/Modules/ModuleServiceProvider.php#L66
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
