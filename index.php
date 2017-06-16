<?php

$twitch = new Twitch("jvtv", "pfake1inxcypryrgbpihlzbctyhmh5"); // Jeux vidéo.com pour l'exemple

?>

<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.10/semantic.min.css">
</head>
<body>


<?php echo $twitch->getIframesSemantic(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.10/semantic.min.js"></script>
<script>
    $('.ui.embed').embed();
</script>
</body>
</html>
