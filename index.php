<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include_once "vendor/autoload.php";
include_once "Twitch.php";

$twitch = new Twitch("jvtv", "pfake1inxcypryrgbpihlzbctyhmh5");
?>

<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.10/semantic.min.css">
</head>
<body>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.10/semantic.min.js"></script>
<script>
    $('.ui.embed').embed();
</script>
</body>
</html>
