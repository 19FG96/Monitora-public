<?php declare(strict_types = 1);

namespace App\Handlers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class COMPANYApiHandler
{
    protected $baseUrl;
    protected $token;

    public function __construct()
    {
        $this->baseUrl = env('COMPANY_API_BASE_URL');
        $this->token = env('COMPANY_API_TOKEN');
    }

    /**
     * Sends a GET request
     *
     * @param string $endpoint
     * @param array $params
     */
    public function sendGetRequest(string $endpoint, array $params = [])
    {
        $url = $this->baseUrl . $endpoint;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->get($url, $params);

        return $response->json();
    }

    /**
     * Sends a POST request
     *
     * @param string $endpoint
     * @param array $data
     * @return Response
     */
    public function sendPostRequest(string $endpoint, array $data = []) : Response
    {
        $url = $this->baseUrl . $endpoint;
        $response = Http::post($url, $data);
        return $response->json();
    }
}