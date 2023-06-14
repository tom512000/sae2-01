<?php

declare(strict_types=1);

use Entity\Film;

$filmId = $_POST['id'];

$film = Film::findById((int)$filmId);

/*Suppression dans la table movie*/
$film->deleteBDD($filmId);

/*Suppression de l'instance $film de Film*/
$film = null;

header("Location: /index.php");
exit;
