<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\MessageBag;

class ClassController extends BaseController
{
    public function index(Request $request)
    {
        $client = new ApiService();
        $response = $client->get('admin/classes');
        $items = [];
        if ($response->success) {
            $items = $response->data['classes'];
        }
        $data = [
            'data' => $items,
        ];

        return view('classes/index', $data);
    }

    public function create()
    {
        $schools = User::getSchools();
        $groups = User::getGroups();

        return view('classes/create', compact('schools', 'groups'));
    }

    public function store()
    {
        $request = \request()->all();
        $client = new ApiService();
        $response = $client->post("admin/classes", $request);

        if (!$response->success) {
            session()->flash('error', $response->errorMsg);

            return redirect()->back()->withInput()->withErrors(new MessageBag($response->errorMsg));
        }

        session()->flash('success', __('Created successfully'));
        return redirect()->route('classes.index');
    }

    public function edit(int $id)
    {
        $schools = User::getSchools();
        $groups = User::getGroups();

        $client = new ApiService();
        $response = $client->get("admin/classes/{$id}");

        if ($response->success) {
            $data = $response->data;
        } else {
            abort(404);
        }

        return view('classes/edit', compact('schools', 'groups', 'data'));
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
