<?php

namespace Modules\Users\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Documents\Entities\Document;
use Modules\Posts\Entities\Post;
use Modules\Users\Entities\Permission;
use Modules\Users\Entities\User;

class EntityPolicy
{

    use HandlesAuthorization;

    /**
     * @param User $user
     */
    public function create(User $user)
    {

    }

    /**
     * @param User $user
     * @param Document|Post $entity
     * @return bool
     */
    public function update(User $user, $entity)
    {
        return $user->is_editor() ||
            $user->hasBranchPermission($entity->branch_id, Permission::where('name', 'full')->first()) ||
            ($entity->status == Post::STATUS_DRAFT && $entity->user_id === \Auth::id());
    }

    /**
     * @param User $user
     * @param Document|Post $entity
     * @return bool
     */
    public function delete(User $user, $entity)
    {
        return $this->update($user, $entity);
    }

    /**
     * @param User $user
     * @param Document|Post $entity
     * @return bool
     */
    public function view(User $user, $entity)
    {
        return $user->is_editor() || $user->read_branch_ids->contains($entity->branch_id);
    }

    /**
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function comment(User $user, Post $post)
    {
        if ($user->is_editor()) {
            return true;
        }

        $permissions = Permission::whereIn('name', ['full', 'store_comment'])->get();

        return (bool)\DB::table('group_user')
            ->join('branch_group', 'branch_group.group_id', '=', 'group_user.group_id')
            ->whereIn('branch_group.permission_id', $permissions->pluck('id'))
            ->where('branch_group.branch_id', $post->branch_id)
            ->where('group_user.user_id', $user->id)
            ->count();
    }
}
