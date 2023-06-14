<?php

declare(strict_types=1);

use Entity\Film;

$filmId = $_POST['filmId'];
$posterId = $_POST['posterId'];
$originalLanguage = $_POST['originalLanguage'];
$originalTitle = $_POST['originalTitle'];
$overview = $_POST['overview'];
$releaseDate = $_POST['releaseDate'];
$runtime = $_POST['runtime'];
$tagline = $_POST['tagline'];
$title = $_POST['title'];

$film = Film::findById((int)$filmId);

/*Création de l'instance $film de Film*/
$film->createInstance($filmId, $posterId, $originalLanguage, $originalTitle, $overview, $releaseDate, $runtime, $tagline, $title);

/*Ajout dans la table movie*/
$film->createBDD($filmId, $posterId, $originalLanguage, $originalTitle, $overview, $releaseDate, $runtime, $tagline, $title);

header("Location: /film.php?filmId={$filmId}");
exit;
