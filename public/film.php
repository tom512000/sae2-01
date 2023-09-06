<?php

declare(strict_types=1);

use Entity\Acteur;
use Entity\Cast;
use Entity\Film;
use Html\AppWebPage;

if (!isset($_GET["filmId"]) || (!ctype_digit($_GET["filmId"]))) {
    header('Location: /index.php');
    exit;
}

$appwebpage = new AppWebPage();

$film = Film::findById((int)$_GET["filmId"]);
if (!$film) {
    http_response_code(404);
    exit;
}

$appwebpage->setTitle("Films - {$film->getTitle()}");

$appwebpage->appendContent("<div class='home'>
                \t<a class='logo' href='index.php'><img class='logo' src='img/home.png' alt='Logo home'/></a>
                \t<a class='logo' href='edit.php?filmId={$film->getId()}'><img class='logo' src='img/edit.png' alt='Logo edit'/></a>
                \t<a class='logo' href='create.php'><img class='logo' src='img/create.png' alt='Logo create'/></a>
                \t<a class='logo' href='delete.php?filmId={$film->getId()}'><img class='logo' src='img/delete.png' alt='Logo delete'/></a>
                </div>");

$appwebpage->appendContent("\t<div class='bloc1'>
                                        <img src='./image.php?posterId={$film->getPosterId()}' alt='Image'/>
                                        <div class='infos'>
                                            <div class='ligne'>
                                                <p class='titre'>{$film->getTitle()}</p>
                                                <p class='date'>{$film->getReleaseDate()}</p>
                                            </div>
                                            <p class='original'>{$film->getOriginalTitle()}</p>
                                            <p class='slogan'>{$film->getTagline()}</p>
                                            <p class='resume'>{$film->getOverview()}</p>
                                        </div>
                                     </div>\n");

$casts = Cast::findByFilmId($film->getId());
foreach ($casts as $cast) {
    $acteur = Acteur::findById($cast->getPeopleId());
    $appwebpage->appendContent("\t<a class='lien2' href='/acteur.php?acteurId={$acteur->getId()}'>
                                        <div class='bloc2'>
                                            <img src='./cast.php?avatarId={$acteur->getAvatarId()}' alt='Image'/>
                                            <div class='infos2'>
                                                <p class='role'>{$cast->getRole()}</p>
                                                <p class='name'>{$acteur->getName()}</p>
                                            </div>
                                        </div>
                                        </a>\n");
}

echo $appwebpage->toHTML();
