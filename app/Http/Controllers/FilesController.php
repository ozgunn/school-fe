<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class FilesController extends BaseController
{
    public function index(Request $request)
    {
        $items = User::getFiles();

        $data = [
            'data' => $items,
        ];

        return view('files/index', $data);
    }

    public function create()
    {
        $groups = User::getGroups();

        return view('files/create', compact('groups'));
    }

    public function store()
    {

        $request = \request()->all();
        $client = new ApiService();

        $response = $client->post("admin/files", $request);

        if (!$response->success) {
            $errorMsg = $response->errorMsg ?? ["Error"];
            session()->flash('error', $errorMsg);

            return redirect()->back()->withInput()->withErrors(new MessageBag($errorMsg));
        }

        session()->flash('success', __('Created successfully'));
        return redirect()->route('files.index');
    }

    public function edit(int $id)
    {
        $schools = User::getSchools();

        $client = new ApiService();
        $response = $client->get("admin/food-menu/{$id}");

        if ($response->success) {
            $data = $response->data;
            if (!empty($data['items'])) {
                $data['first_meal'] = $data['items'][0]['value'];
                $data['second_meal'] = $data['items'][1]['value'];
                $data['third_meal'] = $data['items'][2]['value'];
            }
        } else {
            abort(404);
        }

        return view('food-menu/edit', compact('schools', 'data'));
    }

    public function update(int $id)
    {
        $request = \request()->all();

        $client = new ApiService();
        $response = $client->post("admin/food-menu/{$id}", $request, "put");

        if ($response->success) {
            $data = $response->data;
            session()->flash('success', __('Updated successfully'));
        } else {
            session()->flash('error', $response->errorMsg);

            return view('food-menu/edit')->with('data', $request)->withErrors(new MessageBag([$response->errorMsg]));
        }

        return redirect()->route('food-menu.index');
    }

    public function destroy(int $id)
    {
        $client = new ApiService();
        $response = $client->delete("admin/files/{$id}");

        if ($response->success) {
            return response()->json(['success' => true, 'id' => $id], 200);
        }

        return response()->json(['error' => true, 'errorMsg' => $response->errorMsg], 403);
    }

}
