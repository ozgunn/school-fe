<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiService;
use App\Http\Services\SiteService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class TeacherController extends BaseController
{
    public function index(Request $request)
    {
        $items = User::getTeachers();

        $data = [
            'data' => $items,
        ];

        return view('teachers/index', $data);
    }

    public function create()
    {
        $schools = User::getSchools();
        //$groups = User::getGroups();
        //$schools = SiteService::getSchoolsFromClasses($classes);

        return view('teachers/create', compact('schools'));
    }

    public function store()
    {
        $request = \request()->all();
        $request['role'] = User::ROLE_TEACHER;
        $request['status'] = $request['status'] ? User::STATUS_ACTIVE : User::STATUS_PENDING;

        $client = new ApiService();
        $response = $client->post("admin/users", $request);
        if (!$response->success) {
            session()->flash('error', $response->errorMsg);

            $response->errorMsg = !is_array($response->errorMsg) ? [$response->errorMsg] : $response->errorMsg;
            return back()->withInput()->withErrors(new MessageBag($response->errorMsg));
        }

        session()->flash('success', __('Created successfully'));
        return redirect()->route('teachers.index');
    }

    public function edit(int $id)
    {
        $schools = User::getSchools();
        $data = User::getUser($id);

        return view('teachers/edit', compact('schools', 'data'));
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

            $response->errorMsg = !is_array($response->errorMsg) ? [$response->errorMsg] : $response->errorMsg;
            return back()->withInput()->withErrors(new MessageBag($response->errorMsg));
        }

        return redirect()->route('teachers.index');
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
