<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiService;
use App\Models\User;
use Illuminate\Http\Request;

class PhotoController extends BaseController
{
    public function index(Request $request)
    {
        $items = User::getMedia();

        $data = [
            'data' => $items,
        ];

        return view('photos/index', $data);
    }

    public function destroy(int $id)
    {
        $client = new ApiService();
        $response = $client->delete("admin/media/{$id}");

        if ($response->success) {
            return response()->json(['success' => true, 'id' => $id], 200);
        }

        return response()->json(['error' => true, 'errorMsg' => $response->errorMsg], 403);
    }

}
