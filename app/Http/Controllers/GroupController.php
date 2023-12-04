<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\MessageBag;

class GroupController extends BaseController
{
    public function index(Request $request)
    {
        $items = User::getGroups();

        $data = [
            'data' => $items,
        ];

        return view('groups/index', $data);
    }

    public function create()
    {
        $schools = User::getSchools();

        return view('groups/create', compact('schools'));
    }

    public function store()
    {
        $request = \request()->all();
        $client = new ApiService();
        $response = $client->post("admin/groups", $request);

        if (!$response->success) {
            session()->flash('error', $response->errorMsg);

            return redirect()->back()->withErrors(new MessageBag($response->errorMsg));
        }

        session()->flash('success', __('Created successfully'));
        return redirect()->route('groups.index');
    }

    public function edit(int $id)
    {
        $schools = User::getSchools();

        $client = new ApiService();
        $response = $client->get("admin/groups/{$id}");

        if ($response->success) {
            $data = $response->data;
        } else {
            abort(404);
        }

        return view('groups/edit', compact('schools', 'data'));
    }

    public function update(int $id)
    {
        $request = \request()->all();

        $client = new ApiService();
        $response = $client->post("admin/groups/{$id}", $request, "put");

        if ($response->success) {
            $group = $response->data;
            session()->flash('success', __('Updated successfully'));
        } else {
            session()->flash('error', $response->errorMsg);

            return view('groups/edit')->with('data', $request)->withErrors(new MessageBag($response->errorMsg));
        }

        $data = [
            'data' => $group,
        ];

        return redirect()->route('groups.index');
    }

    public function destroy(int $id)
    {
        $client = new ApiService();
        $response = $client->delete("admin/groups/{$id}");

        if ($response->success) {
            return response()->json(['success' => true, 'id' => $id], 200);
        }

        return response()->json(['error' => true, 'errorMsg' => $response->errorMsg], 403);
    }

}
