<?php

namespace App\Http\Controllers;

use Vendor\Http\Response;

class Controller
{
    public function response()
    {
        return new Response();
    }
}