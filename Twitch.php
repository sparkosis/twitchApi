<?php
use \GuzzleHttp\Client;
Class Twitch{

    private $chaine;
    private $client_id;
    private $twitch = "https://api.twitch.tv/kraken/";

    public function __construct($chaine, $client_id){
        $this->chaine = $chaine;
        $this->client_id = $client_id;

        $this->api = new Client();


    }

    public function Stream(){
        $response = $this->api->get($this->twitch.'streams/'.$this->chaine.'?client_id='.$this->client_id);
        return $response->getBody()->getContents();
    }

    public function IsOn(){

        $Result = json_decode($this->Stream());
        return !is_null($Result->stream);
    }

    public function IsOff(){

        $Result = json_decode($this->Stream());
        return is_null($Result->stream);
    }
}