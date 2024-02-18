<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class ParentController extends BaseController
{
    public function index(Request $request)
    {
        $items = User::getParents();

        $data = [
            'data' => $items,
        ];

        return view('parents/index', $data);
    }

    public function create()
    {
        $schools = User::getSchools();

        return view('parents/create', compact('schools'));
    }

    public function store()
    {
        $request = \request()->all();
        $request['role'] = User::ROLE_PARENT;
        $request['status'] = $request['status'] ? User::STATUS_ACTIVE : User::STATUS_PENDING;

        $client = new ApiService();
        $response = $client->post("admin/users", $request);
        if (!$response->success) {
            session()->flash('error', $response->errorMsg);

            return back()->withInput()->withErrors(new MessageBag([$response->errorMsg]));
        }

        session()->flash('success', __('Created successfully'));
        return redirect()->route('parents.index');
    }

    public function edit(int $id)
    {
        $data = User::getUser($id);
        $schools = User::getSchools();

        return view('parents/edit', compact('schools', 'data'));
    }

    public function update(int $id)
    {
        $request = \request()->all();

        $client = new ApiService();

        $response = $client->post("admin/users/{$id}", $request, "put");

        if ($response->success) {
            session()->flash('success', __('Updated successfully'));
        } else {
            session()->flash('error', $response->errorMsg);

            return redirect()->back()->withInput()->withErrors(new MessageBag([$response->errorMsg]));
        }

        return redirect()->route('parents.index');
    }

    public function destroy(int $id)
    {
        $client = new ApiService();
        $response = $client->delete("admin/users/{$id}");

        if ($response->success) {
            return response()->json(['success' => true, 'id' => $id ], 200);
        }

        return response()->json(['error' => true, 'errorMsg' => $response->errorMsg ], 403);
    }

}
