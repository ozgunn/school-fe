<?php

namespace App\Http\Services;

use App\Models\ApiResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;

class ApiService
{
    public $response;
    private $token;
    private $apiUrl;

    public function __construct()
    {
        $this->response = new ApiResponse();
        $this->token = session()->get('token');
        $this->apiUrl = config('app.apiUrl') . config('app.apiPrefix') . '/';
    }

    public function get($url, $data = [])
    {
        $url = $this->apiUrl . $url;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->get($url, $data);

        return $this->buildResponse($response);
    }

    public function post($url, $data = [], $method=null)
    {
        $url = $this->apiUrl . $url;
        $allowedMethods = ["get", "post", "put", "delete"];
        if ($method && !in_array($method, $allowedMethods))
            throw new NotAcceptableHttpException('Method is not allowed');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        /** @var UploadedFile $pdf */
        if (isset($data['pdf']) && $pdf = $data['pdf']) {
//            $pdf2 = $pdf->store('temp');
//            $pdf3 = file_get_contents(storage_path('app/' . $pdf2));
            $pdfEncoded = mb_convert_encoding($pdf->getContent(), 'UTF-8', 'auto');
            $response = $response->asMultipart()->attach('pdf', $pdf->getContent(), $pdf->getClientOriginalName(), ['Content-Type' => 'application/pdf']);
        }

        if ($method == 'put')
            $response = $response->put($url, $data);
        else
            $response = $response->post($url, $data);

        return $this->buildResponse($response);
    }

    public function delete($url, $data = [])
    {
        $url = $this->apiUrl . $url;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->delete($url, $data);

        return $this->buildResponse($response);
    }

    private function buildResponse($response)
    {
        $this->response->success = $response['success'] ?? null;
        $this->response->error = $response['error'] ?? null;
        $this->response->data = $response['data'] ?? null;
        $this->response->errorMsg = $response['errorMsg'] ?? null;
        $this->response->message = $response['message'] ?? null;
        $this->response->pagination = (isset($response['data']) && isset($response['data']['pagination'])) ? $response['data']['pagination'] : null;

        return $this->response;
    }
}
