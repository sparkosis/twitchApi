<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include_once "vendor/autoload.php";
include_once "Twitch.php";

$twitch = new Twitch("eclypsiatv", "pfake1inxcypryrgbpihlzbctyhmh5");

print_r($twitch->Stream());