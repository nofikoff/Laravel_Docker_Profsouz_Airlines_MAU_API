<?php

namespace Modules\API\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Http\Controllers\Controller;

class APIController extends Controller
{

    /**
     * @param string $ability
     * @param mixed|array $arguments
     * @return bool
     */
    public function authorizeWithoutException(string $ability, $arguments = []): bool
    {
        try {
            $this->authorize($ability, $arguments);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
