#Wrapper php pour Twitch

##Prérequis:

- Composer
- Php
- Curl

##Installation:

```sh
composer install
```

## Initialisation:

```php
include_once "vendor/autoload.php";
include_once "Twitch.php";

$twitch = new Twitch("CHAINE", "CLIENT_ID");

```

##Méthodes:


```php

$twitch->Channel(); //Renvoie un objet Json de Channels
$twitch->IsOn(); //Renvoie true si le stream est en ligne
$twitch->IsOff(); //Renvoie true si le stream est hors ligne
$twitch->getChannelId(); //ID du channel
$twitch->getTitle(); //Titre du stream
$twitch->getFollowers(); //Nombre de Followers
$twitch->RequestToken(); //Demande un token de connexion WIP
$twitch->getBio(); //Description de la chaine
$twitch->getIframesSemantic(); //Chat + lecteur vidéo responsive avec semantic ui (voir exemple: index.php)
$twitch->GetStreamDuration(); //Durée actuelle du stream (Depuis ... heures ... minutes ...)
$twitch->getViewers(); //Nombre de viewers


```

##Credits

Code réalisé par Nicolas Ramos alias Sparkosis
vous pouvez vous servir de cette class sans limite de temps et sans contrainte de ma part.