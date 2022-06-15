<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Auth | Dhon Studio'
        ];

        return view('home', $data);
    }
}
