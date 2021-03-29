<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use Guzzle\Client;

class AccountService
{
    private $url;

    public function __construct()
    {
        $this->url = env('ACCOUNT_SERVICE_URL');
    }

    public function getAccount($id)
    {
        $response = Http::get("{$this->url}/account/read?id={$id}");
        return $response;
    }

    public function getProfile($id)
    {
        $response = Http::get("{$this->url}/profile/read?id={$id}");
        return $response->json();
    }


}