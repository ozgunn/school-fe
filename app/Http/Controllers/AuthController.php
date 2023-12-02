<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiService;
use App\Models\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\UnauthorizedException;

class AuthController extends BaseController
{

    public function login(Request $request)
    {
        $error = "";

        if ($request->isMethod('post')) {
            $client = new ApiService();
            $response = $client->post('login', $request->post());

            if ($response->success === true && isset($response->data['token'])) {
                if ($response->data['user'] && $response->data['user']['role_id'] < User::ROLE_MANAGER) {
                    return view('login', ['error' => 'Access denied']);
                }

                $userData = [
                    'token' => $response->data['token'],
                    'user' => $response->data['user'],
                    'company' => $response->data['user']['company'],
                ];
                session($userData);

                return redirect()->route('home');
            } else {
                $error = $response->error ?? ($response->errorMsg ?? 'error');
                //\session()->flash('error');
            }
        }

        return view('login', compact('error'));
    }

    public function logout(Request $request)
    {
       Session::flush();

       return redirect('login');
    }
}
