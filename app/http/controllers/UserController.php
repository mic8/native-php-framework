<?php

namespace App\Http\Controllers;

use Vendor\Database\Builder;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new Builder('users');
    }

    public function index()
    {
        $data = $this->user->all();

        return $this->response()->json($data);
    }
}