<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Modules\Documents\Entities\Document;
use Modules\Posts\Entities\Branch;
use Modules\Posts\Entities\Comment;
use Modules\Posts\Entities\Post;
use Modules\Posts\Entities\PostQuestion;
use Modules\Posts\Entities\SystemPost;
use Modules\Users\Entities\Group;
use Modules\Users\Policies\BranchPolicy;
use Modules\Users\Policies\CommentPolicy;
use Modules\Users\Policies\EntityPolicy;
use Modules\Users\Policies\GroupPolicy;
use Modules\Users\Policies\PostQuestionPolicy;
use Modules\Users\Policies\SystemPostPolicy;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class         => EntityPolicy::class,
        Document::class     => EntityPolicy::class,
        Branch::class       => BranchPolicy::class,
        Comment::class      => CommentPolicy::class,
        PostQuestion::class => PostQuestionPolicy::class,
        Group::class        => GroupPolicy::class,
        SystemPost::class   => SystemPostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
