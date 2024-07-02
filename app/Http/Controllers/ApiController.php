<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function fetchUserData(Request $request)
    {
        // Call API to fetch user data
        $response = Http::get('https://api.example.com/user');
        $userData = $response->json();

        return $this->success($userData);
    }

    public function fetchPostData(Request $request)
    {
        // Call API to fetch post data
        $response = Http::get('https://api.example.com/posts');
        $postData = $response->json();

        return $this->success($postData);
    }

    // Add more methods for other API calls as needed
}
