<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class StudentController extends BaseController
{
    public function index(Request $request)
    {
        $items = User::getStudents();

        $data = [
            'data' => $items,
        ];

        return view('students/index', $data);
    }

    public function create()
    {
        $schools = User::getSchools();
        $groups = User::getGroups();
        $classes = User::getClasses();
        $teachers = User::getTeachers();
        $buses = User::getBuses(1);

        return view('students/create', compact('schools', 'groups', 'classes', 'teachers', 'buses'));
    }

    public function store()
    {
        $request = \request()->all();

        $client = new ApiService();
        $response = $client->post("admin/students", $request);
        if (!$response->success) {
            session()->flash('error', $response->errorMsg);

            return back()->withInput()->withErrors(new MessageBag($response->errorMsg));
        }

        session()->flash('success', __('Created successfully'));
        return redirect()->route('students.index');
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

        return view('students/edit', compact('schools', 'groups', 'data', 'teachers'));
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

        return redirect()->route('students.index');
    }

    public function destroy(int $id)
    {
        $client = new ApiService();
        $response = $client->delete("admin/classes/{$id}");

        if ($response->success) {
            return response()->json(['success' => true, 'id' => $id], 200);
        }

        return response()->json(['error' => true, 'errorMsg' => $response->errorMsg], 403);
    }

}
