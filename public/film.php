<?php

declare(strict_types=1);

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
$appwebpage->appendContent("\t<div class='bloc'>
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

echo $appwebpage->toHTML();
