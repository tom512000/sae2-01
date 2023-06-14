<?php

declare(strict_types=1);

use Entity\Film;

$filmId = $_POST['id'];
$posterId = $_POST['posterId'];
$originalLanguage = $_POST['originalLanguage'];
$originalTitle = $_POST['originalTitle'];
$overview = $_POST['overview'];
$releaseDate = $_POST['releaseDate'];
$runtime = $_POST['runtime'];
$tagline = $_POST['tagline'];
$title = $_POST['title'];

$film = Film::findById((int)$filmId);
$film->editBDD((int)$posterId, $originalLanguage, $originalTitle, $overview, $releaseDate, (int)$runtime, $tagline, $title);

header("Location: /film.php?filmId={$filmId}");
exit;
