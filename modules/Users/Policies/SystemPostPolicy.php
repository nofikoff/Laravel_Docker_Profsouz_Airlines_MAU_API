<?php

namespace Modules\Users\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Posts\Entities\SystemPost;
use Modules\Users\Entities\User;

class SystemPostPolicy
{

    use HandlesAuthorization;

    /**
     * @param User $user
     * @param SystemPost $systemPost
     * @return bool
     */
    public function destroy(User $user, SystemPost $systemPost)
    {
        return $systemPost->user_id === $user->id;
    }
}
