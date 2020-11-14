<?php

namespace Modules\Posts\Providers;

use Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Posts\Entities\Branch;
use Modules\Posts\Entities\Comment;
use Modules\Posts\Entities\Post;
use Modules\Posts\Observers\BranchObserver;
use Modules\Posts\Observers\CommentObserver;
use Modules\Posts\Observers\PostObserver;
use Modules\Posts\Observers\PostQuestionObserver;
use Modules\Posts\Entities\PostQuestion;

class PostsServiceProvider extends ServiceProvider
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
        Comment::observe(CommentObserver::class);
        Post::observe(PostObserver::class);
        PostQuestion::observe(PostQuestionObserver::class);
        Branch::observe(BranchObserver::class);


        \Validator::extend('user_edit_branch', function ($attribute, $value, $parameters, $validator) {

            return $value == 'foo';
        });

        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        //$this->publishes([
        //    __DIR__.'/../Config/config.php' => config_path('posts.php'),
        //], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'posts'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        //$viewPath = resource_path('views/modules/posts');

        $sourcePath = __DIR__.'/../resources/views';

        //$this->publishes([
        //   $sourcePath => $viewPath
        //]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/posts';
        }, Config::get('view.paths')), [$sourcePath]), 'posts');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/posts');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'posts');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../resources/lang', 'posts');
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
