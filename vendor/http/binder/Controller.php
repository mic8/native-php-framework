<?php

/**
 * @author Michael Reynald <michaelreynald78@gmail.com>
 * Traits for app\http\controller
 * Binding all methods that are used by any controllers
 */

namespace Vendor\Http\Binder;

use Vendor\Http\Response;
use Vendor\Compiler\View;

trait Controller
{
    public function response()
    {
        return new Response();
    }

    public function view($target = '', $params = [])
    {
        $render = new View($target, $params);

        return $render->init();
    }
}