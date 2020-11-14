<?php

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Blade;
use Illuminate\Support\ServiceProvider;
use Modules\Posts\Entities\Post;
use Modules\Posts\Entities\Comment;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Posts\Entities\PostQuestion;
use Modules\Documents\Entities\Document;
use Modules\Users\Entities\User;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'post'     => Post::class,
            'comment'  => Comment::class,
            'question' => PostQuestion::class,
            'document' => Document::class,
            'user'     => User::class,
        ]);

        Blade::directive('strToPdf', function ($string) {
            list($str, $count) = explode(',', $string);

            if (mb_strlen($str) < (int)$count) {
                return "<?php echo $str . str_repeat(\"&nbsp;\", $count - mb_strlen($str)); ?>";
            } else {
                return "<?php echo $str; ?>";
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        $this->app->singleton('sms.provider', function () {
            return new SMSProvider();
        });
    }
}
