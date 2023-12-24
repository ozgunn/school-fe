<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class UserController extends BaseController
{
    public function index(Request $request)
    {
        $client = new ApiService();
        $admins = $client->get('admin/users', ['role' => User::ROLE_ADMIN]);
        $items = [];
        if ($admins->success) {
            $items = $admins->data['users'];
        }
        $managers = $client->get('admin/users', ['role' => User::ROLE_MANAGER]);
        if ($managers->success) {
            $items = array_merge($items, $managers->data['users']);
        }

        $data = [
            'data' => $items,
        ];

        return view('users/index', $data);
    }

    public function create()
    {
        $schools = User::getSchools();

        return view('users/create', compact('schools'));
    }

    public function store()
    {
        $request = \request()->all();
        $client = new ApiService();
        dd($request);
        $response = $client->post("admin/users", $request);

        if (!$response->success) {
            session()->flash('error', $response->errorMsg);

            return redirect()->back()->withInput()->withErrors(new MessageBag($response->errorMsg));
        }

        session()->flash('success', __('Created successfully'));
        return redirect()->route('users.index');
    }

    public function edit(int $id)
    {
        $client = new ApiService();
        $response = $client->get("admin/classes/{$id}");

        if ($response->success) {
            $data = $response->data;
        } else {
            abort(404);
        }

        $schools = User::getSchools();
        $groups = User::getGroups();
        $teachers = User::getTeachers($data['school']['id']);

        return view('classes/edit', compact('schools', 'groups', 'data', 'teachers'));
    }

    public function update(int $id)
    {
        $request = \request()->all();

        $client = new ApiService();
        $response = $client->post("admin/classes/{$id}", $request, "put");

        if ($response->success) {
            session()->flash('success', __('Updated successfully'));
        } else {
            session()->flash('error', $response->errorMsg);

            return redirect()->back()->withInput()->withErrors(new MessageBag($response->errorMsg));
        }

        return redirect()->route('classes.index');
    }

    public function destroy(int $id)
    {
        $client = new ApiService();
        $response = $client->delete("admin/classes/{$id}");

        if ($response->success) {
            return response()->json(['success' => true, 'id' => $id ], 200);
        }

        return response()->json(['error' => true, 'errorMsg' => $response->errorMsg ], 403);
    }

}
