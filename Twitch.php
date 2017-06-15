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

    private function Stream(){
        $response = $this->api->get($this->twitch.'streams/'.$this->chaine.'?client_id='.$this->client_id);
        return json_decode($response->getBody()->getContents());
    }

    private function Channel(){
        return $this->Stream()->stream->channel;
    }

    public function IsOn(){

        $Result = $this->Stream();
        return !is_null($Result->stream);
    }

    public function IsOff(){

        $Result = json_decode($this->Stream());
        return is_null($Result->stream);
    }

    public function getTitle(){
        if($this->IsOn()){
            return $this->Channel()->status;
        } else {
            return false;
        }
    }
    public function getViewers(){
        if($this->IsOn()){
            return $this->Stream()->stream->viewers;
        } else {
            return false;
        }
    }
}