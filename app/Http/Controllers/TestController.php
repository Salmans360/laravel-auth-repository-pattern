<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{

    public function index()
    {
        $apiUrl = route('api.data'); // Generate the URL for the API route

        $client = new Client();

        $response = $client->request('GET', $apiUrl);

        $data = json_decode($response->getBody());

        //echo "<pre>"; print_r($data); die;
        // $response = Http::get($apiUrl);

        /*$data = collect($response->json())->map(function ($item) {
            return (object) $item;
        })->toArray();

        $data = $response->json();*/

        return view('test', ['data' => $data]);
    }
}
