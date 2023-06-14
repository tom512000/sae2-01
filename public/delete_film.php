<?php

declare(strict_types=1);

use Entity\Film;

$filmId = $_POST['id'];

$film = Film::findById((int)$filmId);
$film->deleteBDD((int)$filmId);

header("Location: /index.php");
exit;
