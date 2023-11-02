<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Anasayfa'
        ];

        return view('dashboard', $data);
    }
}
