<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'message' => 'Hello world'
        ];

        return $this->view('home/index', $data);
    }
}