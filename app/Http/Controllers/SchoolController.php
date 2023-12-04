<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\MessageBag;

class SchoolController extends BaseController
{
    public function index(Request $request)
    {
        $schools = User::getSchools();
//        $pagination = [];
//        $pagination = $response->pagination;
//        $pagination['path'] = $request->url();
        $data = [
            'data' => $schools,
//            'data' => $this->paginateData($schools, $pagination),
//            'pagination' => $pagination,
        ];

        return view('schools/index', $data);
    }

    public function show()
    {
        $data = [
            'title' => 'Anasayfa'
        ];

        return view('dashboard', $data);
    }

    public function create()
    {
        return view('schools/create');
    }

    public function store()
    {
        $request = \request()->all();
        $client = new ApiService();
        $response = $client->post("admin/schools", $request);

        if (!$response->success) {
            session()->flash('error', $response->errorMsg);

            return view('schools/create')->with('data', $request)->withErrors(new MessageBag($response->errorMsg));
        }

        session()->flash('success', __('Created successfully'));
        return redirect()->route('schools.index');
    }

    public function edit(int $id)
    {
        $client = new ApiService();
        $response = $client->get("admin/schools/{$id}");

        if ($response->success) {
            $school = $response->data;
        } else {
            abort(404);
        }

        $data = [
            'data' => $school,
        ];

        return view('schools/edit', $data);
    }

    public function update(int $id)
    {
        $request = \request()->all();

        $client = new ApiService();
        $response = $client->post("admin/schools/{$id}", $request, "put");

        if ($response->success) {
            $school = $response->data;
            session()->flash('success', __('Updated successfully'));
        } else {
            session()->flash('error', $response->errorMsg);

            return view('schools/edit')->with('data', $request)->withErrors(new MessageBag($response->errorMsg));
        }

        return redirect()->route('schools.index');

    }

    public function destroy(int $id)
    {
        $client = new ApiService();
        $response = $client->delete("admin/schools/{$id}");

        if ($response->success) {
            return response()->json(['success' => true, 'id' => $id], 200);
        }

        return response()->json(['error' => true, 'errorMsg' => $response->errorMsg], 403);
    }

    protected function paginateData($items, $pagination)
    {
        $perPage = $pagination['per_page'] ?? 10;
        $currentPage = $pagination['current_page'] ?? 1;
        $total = $pagination['total'] ?? 0;

        $paginatedData = new \Illuminate\Pagination\LengthAwarePaginator($items, $total, $perPage, $currentPage);

        return $paginatedData;
    }
}
