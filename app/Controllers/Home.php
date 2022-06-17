<?php

namespace App\Controllers;

date_default_timezone_set('Asia/Jakarta');

use App\Libraries\DhonHit;

class Home extends BaseController
{
    protected $dhonhit;

    public function __construct()
    {
        $this->dhonhit = new DhonHit;
        $this->dhonhit->collect();
    }

    public function index()
    {
        $data = [
            'title' => 'Auth | Dhon Studio',
            'favicon' => 'icon.ico'
        ];

        return view('home', $data);
    }
}
