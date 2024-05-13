<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LogController extends BaseController
{
    public function index(Request $request)
    {
        $items = User::getLogs();

        $data = [
            'data' => $items,
        ];

        return view('logs/index', $data);
    }

}
