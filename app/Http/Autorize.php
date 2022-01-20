<?php

namespace App\Http;

use http\Env\Request;
use Illuminate\Support\Facades\Http;

class Autorize
{
        public $code;
        public $client_id;
        public $client_secret;

    public function __construct($code, $client_id, $client_secret){
            $this->code = $code;
            $this->client_id = $client_id;
            $this->client_secret = $client_secret;
        }
    public function Refresh(){
        $response = Http::asForm()->post('https://accounts.zoho.com/oauth/v2/token', [
            'code' => $this->code,
            'redirect_uri' => 'https://exapmlexapmle.ua/vova',
            'client_id' => $this->client_id ,
            'client_secret' => $this->client_secret,
            'grant_type' => 'authorization_code'
        ]);
        if(!isset($response->json()["refresh_token"])){
            return redirect()->route('home')->with(['error' => 'Not correct data']);
        }
        return $refresh_token = $response->json()["refresh_token"];
    }
    public function Access($refresh){

        $access = Http::asForm()->post('https://accounts.zoho.com/oauth/v2/token', [
            'refresh_token' => $refresh,
            'redirect_uri' => 'https://exapmlexapmle.ua/vova',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'grant_type' => 'refresh_token'
        ]);
        $access_token = $access->json()["access_token"];

        return redirect()->route('deal')->with('access_token', $access_token);
    }
}
