<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Anasayfa'
        ];

        return view('dashboard', $data);
    }

    public function language(Request $request)
    {
        $lang = $request->get('lang');
        if ($lang && in_array($lang, config('app.languages'))) {
            App::setLocale($lang);
            session(['locale' => $lang]);
        }
//        if ($request->path() == "language")
//            return redirect()->home();

        return redirect()->back();
    }
}
