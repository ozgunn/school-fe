<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class DailyReportController extends BaseController
{
    public function index(Request $request)
    {
        $items = User::getDailyReports();
//        $classes = User::getClasses();
//        $classesArr = array_column($classes, 'name', 'id');

        $data = [
            'data' => $items,
        ];

        return view('daily-reports/index', $data);
    }

    public function show(int $id)
    {
        $client = new ApiService();
        $response = $client->get("admin/daily/{$id}");

        if ($response->success) {
            $data = $response->data;
            return view('daily-reports/show', compact('data'));
        }

        return response()->json(['error' => true, 'errorMsg' => $response->errorMsg], 403);
    }

    public function destroy(int $id)
    {
        $client = new ApiService();
        $response = $client->delete("admin/daily/{$id}");

        if ($response->success) {
            return response()->json(['success' => true, 'id' => $id], 200);
        }

        return response()->json(['error' => true, 'errorMsg' => $response->errorMsg], 403);
    }

}
