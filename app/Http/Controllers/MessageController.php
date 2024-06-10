<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class MessageController extends BaseController
{
    public function index(Request $request)
    {
        $sent = $request->get('sent');
        $result = User::getMessages($sent);

        $data = [
            'data' => $result['messages'],
            'pagination' => $result['pagination'],
        ];

        return view('messages/index', $data);
    }

    public function show(int $id)
    {
        $client = new ApiService();
        $response = $client->get("admin/messages/{$id}");

        if ($response->success) {
            $data = $response->data;
            return view('messages/show', compact('data'));
        }

        return response()->json(['error' => true, 'errorMsg' => $response->errorMsg], 403);
    }

    public function create()
    {
        $schools = User::getSchools();
        $students = User::getStudents();

        return view('messages/create', compact('schools', 'students'));
    }

    public function store()
    {
        $request = \request()->all();
        $client = new ApiService();
        $response = $client->post("admin/messages", $request);

        if (!$response->success) {
            session()->flash('error', $response->errorMsg);

            return redirect()->back()->withInput()->withErrors(new MessageBag($response->errorMsg));
        }

        session()->flash('success', __('Message sent'));
        return redirect()->route('messages.show', ['message' => $response->data['id']]);
    }

    public function destroy(int $id)
    {
        abort(404);
        $client = new ApiService();
        $response = $client->delete("admin/messages/{$id}");

        if ($response->success) {
            return response()->json(['success' => true, 'id' => $id], 200);
        }

        return response()->json(['error' => true, 'errorMsg' => $response->errorMsg], 403);
    }

}
