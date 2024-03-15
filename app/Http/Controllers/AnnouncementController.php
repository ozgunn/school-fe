<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class AnnouncementController extends BaseController
{
    public function index(Request $request)
    {
        $items = User::getAnnouncements();

        $data = [
            'data' => $items,
        ];

        return view('announcements/index', $data);
    }

    public function create()
    {
        $schools = User::getSchools();
        $groups = User::getGroups();
        $classes = User::getClasses();
        //$teachers = User::getTeachers();

        return view('announcements/create', compact('schools', 'groups', 'classes'));
    }

    public function store()
    {
        $request = \request()->all();

        $client = new ApiService();
        $response = $client->post("admin/announcements", $request);
        if (!$response->success) {
            session()->flash('error', $response->errorMsg);

            return back()->withInput()->withErrors(new MessageBag([$response->errorMsg]));
        }

        session()->flash('success', __('Created successfully'));
        return redirect()->route('announcements.index');
    }

    public function edit(int $id)
    {
        abort(403);

        $client = new ApiService();
        $response = $client->get("admin/students/{$id}");

        if ($response->success) {
            $data = $response->data;
        } else {
            abort(404);
        }

        $schools = User::getSchools();
        $groups = User::getGroups();
        $classes = User::getClasses();
        $buses = User::getBuses(1);
        $parents = User::getParents();

        return view('students/edit', compact('schools', 'data', 'groups', 'classes', 'buses', 'parents'));
    }

    public function update(int $id)
    {
        abort(403);
        $request = \request()->all();

        $client = new ApiService();
        $response = $client->post("admin/students/{$id}", $request, "put");

        if ($response->success) {
            session()->flash('success', __('Updated successfully'));
        } else {
            session()->flash('error', $response->errorMsg);

            return redirect()->back()->withInput()->withErrors(new MessageBag([$response->errorMsg]));
        }

        return redirect()->route('students.index');
    }

    public function destroy(int $id)
    {
        abort(403);
        $client = new ApiService();
        $response = $client->delete("admin/students/{$id}");

        if ($response->success) {
            return response()->json(['success' => true, 'id' => $id], 200);
        }

        return response()->json(['error' => true, 'errorMsg' => $response->errorMsg], 403);
    }

}
