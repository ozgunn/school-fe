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
        $groups = User::getGroups();

        $client = new ApiService();
        $response = $client->get("admin/files/{$id}");

        if ($response->success) {
            $data = $response->data;
        } else {
            abort(404);
        }

        return view('files/edit', compact('groups', 'data'));
    }

    public function update(int $id)
    {
        $request = \request()->all();

        $client = new ApiService();
        $response = $client->post("admin/files/{$id}", $request, "put");

        if ($response->success) {
            $data = $response->data;
            session()->flash('success', __('Updated successfully'));
        } else {
            session()->flash('error', $response->errorMsg);

            return redirect()->back()->withInput()->withErrors(new MessageBag([$response->errorMsg]));
        }

        return redirect()->route('files.index');
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
