<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\MessageBag;

class BusController extends BaseController
{
    public function index(Request $request)
    {
        $items = User::getBuses();

        $data = [
            'data' => $items,
        ];

        return view('buses/index', $data);
    }

    public function create()
    {
        $schools = User::getSchools();
        $teachers = User::getTeachers();

        return view('buses/create', compact('schools', 'teachers'));
    }

    public function store()
    {
        $request = \request()->all();
        $client = new ApiService();
        $response = $client->post("admin/buses", $request);

        if (!$response->success) {
            session()->flash('error', $response->errorMsg);

            return redirect()->back()->withErrors(new MessageBag([$response->errorMsg]));
        }

        session()->flash('success', __('Created successfully'));
        return redirect()->route('buses.index');
    }

    public function edit(int $id)
    {
        $schools = User::getSchools();
        $teachers = User::getTeachers();

        $client = new ApiService();
        $response = $client->get("admin/buses/{$id}");

        if ($response->success) {
            $data = $response->data;
        } else {
            abort(404);
        }

        return view('buses/edit', compact('schools', 'data', 'teachers'));
    }

    public function update(int $id)
    {
        $request = \request()->all();

        $client = new ApiService();
        $response = $client->post("admin/buses/{$id}", $request, "put");

        if ($response->success) {
            $data = $response->data;
            session()->flash('success', __('Updated successfully'));
        } else {
            session()->flash('error', $response->errorMsg);

            return view('buses/edit')->with('data', $request)->withErrors(new MessageBag([$response->errorMsg]));
        }

        return redirect()->route('buses.index');
    }

    public function destroy(int $id)
    {
        $client = new ApiService();
        $response = $client->delete("admin/buses/{$id}");

        if ($response->success) {
            return response()->json(['success' => true, 'id' => $id], 200);
        }

        return response()->json(['error' => true, 'errorMsg' => $response->errorMsg], 403);
    }

}
