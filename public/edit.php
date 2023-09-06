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

$appwebpage->setTitle("Films - Modifier {$film->getTitle()}");

$appwebpage->appendContent("<div class='form'>
                                       <form method='POST' action='edit_film.php'>
                                       <input type='hidden' name='id' value='{$film->getId()}'>
                                    
                                       <label for='posterId'>ID de l'affiche :</label>
                                       <input type='text' name='posterId' id='posterId' value='{$film->getPosterId()}'>

                                       <label for='originalLanguage'>Langue originale :</label>
                                       <input type='text' name='originalLanguage' id='originalLanguage' value='{$film->getOriginalLanguage()}'>

                                       <label for='originalTitle'>Titre original :</label>
                                       <input type='text' name='originalTitle' id='originalTitle' value='{$film->getOriginalTitle()}'>

                                       <label for='overview'>Synopsis :</label>
                                       <textarea name='overview' id='overview'>{$film->getOverview()}</textarea>

                                       <label for='releaseDate'>Date de sortie :</label>
                                       <input type='text' name='releaseDate' id='releaseDate' value='{$film->getReleaseDate()}'>

                                       <label for='runtime'>Durée :</label>
                                       <input type='text' name='runtime' id='runtime' value='{$film->getRuntime()}'>

                                       <label for='tagline'>Accroche :</label>
                                       <input type='text' name='tagline' id='tagline' value='{$film->getTagline()}'>

                                       <label for='title'>Titre :</label>
                                       <input type='text' name='title' id='title' value='{$film->getTitle()}'>

                                       <button type='submit'>Modifier</button>
                                       </form>
                                   </div>");

echo $appwebpage->toHTML();
