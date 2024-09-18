<?php

namespace App\Http\Controllers;

use App\Models\GitHubApi;

class GitHubController extends Controller
{
    public function getUser($userName, GitHubApi $gitHubApi)
    {
        $endPoint = env('GITHUB_API_URL') . "/users/{$userName}";
        $response = $gitHubApi->sendRequest('GET', $endPoint);

        $followingList = $this->getFollowing($userName, $gitHubApi);

        $data = array_merge((array)$response, ['followingList' => $followingList]);

        return response()->json($data);
    }

    private function getFollowing($userName, $gitHubApi)
    {
        $endPoint = env('GITHUB_API_URL') . "/users/{$userName}/following";
        $response = $gitHubApi->sendRequest('GET', $endPoint);

        $followingWithDetails = [];

        foreach ((array)$response as $user) {
            $endPoint = env('GITHUB_API_URL') . "/users/{$user->login}";
            $userDetailsResponse = $gitHubApi->sendRequest('GET', $endPoint);

            $followingWithDetails[] = array_merge((array)$user, [
                'name' => $userDetailsResponse->name,
                'company' => $userDetailsResponse->company,
                'location' => $userDetailsResponse->location,
                'bio' => $userDetailsResponse->bio,
                'public_repos' => $userDetailsResponse->public_repos
            ]);
        }

        return $followingWithDetails;
    }
}
