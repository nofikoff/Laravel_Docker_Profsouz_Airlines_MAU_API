<?php

namespace Modules\Users\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Posts\Entities\Comment;
use Modules\Users\Entities\Permission;
use Modules\Users\Entities\User;

class CommentPolicy
{

    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Comment $comment
     * @return bool
     */
    public function delete(User $user, Comment $comment)
    {
        return $user->is_editor() || $user->id === $comment->user_id || $user->id === $comment->post->user_id ||
            $user->hasBranchPermission($comment->post->branch_id, Permission::where('name', 'full')->first());
    }

    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }
}