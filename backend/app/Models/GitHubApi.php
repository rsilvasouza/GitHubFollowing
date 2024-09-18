<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GitHubApi extends Model
{
    use HasFactory;

    protected $client;
    protected $gitHubUrl;
    protected $gitHubToken;

    public function __construct()
    {
        $this->client = new Client();
        $this->gitHubUrl = env('GITHUB_API_URL');
        $this->gitHubToken = env('GITHUB_TOKEN');
    }

    public function sendRequest($method, $endPoint)
    {
        $headers = [];
        if (!empty($this->gitHubToken)) {
            $headers['Authorization'] = 'token ' . trim($this->gitHubToken);
        }

        $startTime = microtime(true);

        try {
            $response = $this->client->request($method, $endPoint, ['headers' => $headers]);

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();
            $responseHeaders = $response->getHeaders();
        } catch (\Exception $e) {
            $statusCode = $e->getCode();
            $responseBody = $e->getMessage();
            $responseHeaders = [];
        }

        $duration = microtime(true) - $startTime;

        $logData = [
            'endpoint' => $endPoint,
            'method' => $method,
            'status_code' => $statusCode,
            'response_body' => json_encode($responseBody),
            'response_headers' => json_encode($responseHeaders),
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'duration_ms' => $duration * 1000,
        ];

        Log::create($logData);

        return json_decode($responseBody);
    }
}
