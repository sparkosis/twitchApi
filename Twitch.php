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

    public function Channel(){
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

    public function getChannelId(){
        return $this->Channel()->_id;
    }

    public function getTitle(){
        if($this->IsOn()){
            return $this->Channel()->status;
        } else {
            return false;
        }
    }

    public function getFollowers(){
        if($this->IsOn()){
            return $this->Channel()->followers;
        } else {
            return 0;
        }
    }

    public function RequestToken($urlToRedirect){

        $url = $this->twitch.'oauth2/authorize
                ?client_id='.$this->client_id.'
                &redirect_uri='.$urlToRedirect.'
                &response_type=token id_token
                &scope=channel_editor';

        $this->api->get($url);

    }

    public function GetStreamDuration(){
        if($this->IsOn()){
            $now = strtotime("now");
            $created_at = strtotime($this->Stream()->stream->created_at);
            return $this->diffDate($created_at, $now);
        } else {
            return 0;
        }
    }
    private function diffDate($dateStart, $dateEnd){
        $start  = date('Y-m-d H:i:s',$dateStart);
        $end    = date('Y-m-d H:i:s',$dateEnd);
        $d_start    = new DateTime($start);
        $d_end      = new DateTime($end);
        $diff = $d_start->diff($d_end);
        return $diff->format('Depuis %d jour(s) %h heure(s) et %i minute(s)');
    }
    public function SetTitle($access_token = NULL, $title){
        if(!is_null($access_token)){

        }
        else {
            return false;
        }
    }

    public function getViewers(){
        if($this->IsOn()){
            return $this->Stream()->stream->viewers;
        } else {
            return 0;
        }
    }
}