<?php

declare(strict_types=1);

use Entity\Acteur;
use Entity\Cast;
use Entity\Film;
use Html\AppWebPage;

if (!isset($_GET["acteurId"]) || (!ctype_digit($_GET["acteurId"]))) {
    header('Location: /index.php');
    exit;
}

$appwebpage = new AppWebPage();

$acteur = Acteur::findById((int)$_GET["acteurId"]);
if (!$acteur) {
    http_response_code(404);
    exit;
}

$appwebpage->setTitle("Films - {$acteur->getName()}");

$death = $acteur->getDeathday();
$appwebpage->appendContent("\t<div class='bloc'>
                                        <img src='./image.php?posterId={$acteur->getAvatarId()}' alt='Image'/>
                                        <div class='infos3'>
                                            <p class='name2'>{$acteur->getName()}</p>
                                            <p class='naissance'>{$acteur->getPlaceOfBirth()}</p>
                                            <div class='ligne2'>
                                                <p class='datenais'>{$acteur->getBirthday()}</p>
                                                <p class='espace'> - </p>
                                                <p class='datemort'>{$acteur->getDeathday()}</p>
                                            </div>
                                            <p class='biographie'>{$acteur->getBiography()}</p>
                                        </div>
                                     </div>\n");

$casts = Cast::findByActorId($acteur->getId());
foreach ($casts as $cast) {
    $film = Film::findById($cast->getMovieId());
    $appwebpage->appendContent("\t<a class='lien2' href='/film.php?filmId={$film->getId()}'>
                                        <div class='bloc3'>
                                            <img src='./image.php?posterId={$film->getPosterId()}' alt='Image'/>
                                            <div class='infos4'>
                                                <p class='titre2'>{$film->getTitle()}</p>
                                                <p class='date2'>{$film->getReleaseDate()}</p>
                                            </div>
                                            <p class='role2'>{$cast->getRole()}</p>
                                        </div>
                                        </a>\n");
}

echo $appwebpage->toHTML();
