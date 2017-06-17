<?php
/**
 * Créateur: Sparkosis
 * Le: 16/06/2017 à 15h10
 * Class Twitch API Wrapper
 *
 */
use \GuzzleHttp\Client;

Class Twitch{

    private $chaine;
    protected $client_id;
    protected $twitch = "https://api.twitch.tv/kraken/";

    /**
     * Twitch constructor.
     * @param $chaine
     * @param $client_id
     */

    public function __construct($chaine, $client_id){
        $this->chaine = $chaine;
        $this->client_id = $client_id;

        $this->api = new Client();


    }

    /**
     * @return mixed
     */
    private function Stream(){
        $response = $this->api->get($this->twitch.'streams/'.$this->chaine.'?client_id='.$this->client_id);
        return json_decode($response->getBody()->getContents());
    }

    /**
     * @return mixed
     */
    public function Channel(){
        return $this->Stream()->stream->channel;
    }

    /**
     * @return bool true si est en ligne, false sinon
     */
    public function IsOn(){

        $Result = $this->Stream();
        if(!is_object($Result)){
          return !is_null(json_decode($Result)->stream);
        }else{
          return !is_null($Result->stream);
        }
    }

    /**
     * @return mixed Channel ID
     */
    public function getChannelId(){
        return $this->Channel()->_id;
    }

    /**
     * @return bool Titre du stream
     */
    public function getTitle(){

            return $this->Channel()->status;

    }

    /**
     * @return int Nombre de followers
     */
    public function getFollowers(){
        if($this->IsOn()){
            return $this->Channel()->followers;
        } else {
            return 0;
        }
    }

    /**
     * @param $urlToRedirect demande un token de connexion
     */
    public function RequestToken($urlToRedirect){

        $url = $this->twitch.'oauth2/authorize
                ?client_id='.$this->client_id.'
                &redirect_uri='.$urlToRedirect.'
                &response_type=token id_token
                &scope=channel_editor';

        $this->api->get($url);

    }

    /**
     * @return mixed Description
     */
    public function getBio(){
        $response = $this->api->get($this->twitch.'users/'.$this->chaine.'?client_id='.$this->client_id);
        $result = json_decode($response->getBody()->getContents());
        return $result->bio;
    }

    /**
     * @return string Lecteur + chat pour semantic ui
     */
    public function getIframesSemantic(){

        $html = " <div class=\"ui two column grid container\">
        <div class=\"ten wide column\">
            <div class=\"ui embed\" data-url=\"http://player.twitch.tv/?channel=$this->chaine\" data-placeholder=\"/images/bear-waving.jpg\"></div>
        </div>
        <div class=\"six wide column\">
            <div class=\"ui embed\" data-url=\"https://www.twitch.tv/$this->chaine/chat\"></div>
        </div>
    </div>";

    return $html;
    }

    /**
     * @return int|string depuis quand le live est en ligne
     */
    public function GetStreamDuration(){
        if($this->IsOn()){
            $now = strtotime("now");
            $created_at = strtotime($this->Stream()->stream->created_at);
            return $this->diffDate($created_at, $now);
        } else {
            return 0;
        }
    }

    /**
     * @param $dateStart
     * @param $dateEnd
     * @return string
     * Calcul la différence de date
     */
    private function diffDate($dateStart, $dateEnd){
        $start  = date('Y-m-d H:i:s',$dateStart);
        $end    = date('Y-m-d H:i:s',$dateEnd);
        $d_start    = new DateTime($start);
        $d_end      = new DateTime($end);
        $diff = $d_start->diff($d_end);
        return $diff->format('Depuis %d jour(s) %h heure(s) et %i minute(s)');
    }

    /**
     * @return int Nombre de viewers
     */
    public function getViewers(){
        if($this->IsOn()){
            return $this->Stream()->stream->viewers;
        } else {
            return 0;
        }
    }
}