<?php

namespace App\Http\Controllers\UsersManagement;

class HomeController
{
    public function index()
    {
        return view('dashboard.dashboard')->with(['title'=>'Beranda',]);
    }
}
