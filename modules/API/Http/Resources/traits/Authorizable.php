<?php

namespace Modules\API\Http\Resources\Traits;

trait Authorizable
{

    /**
     * @param string $ability
     * @param $post
     * @return bool
     */
    public function authorizeWithoutException(string $ability, $post): bool
    {
        try {
            \Gate::authorize($ability, $post);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}