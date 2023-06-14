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

$appwebpage->setTitle("Films - Supprimer {$film->getTitle()}");

$appwebpage->appendContent("<div class='form'>
                                       <form method='POST' action='delete_film.php'>
                                       <input type='hidden' name='id' value='{$film->getId()}'>
                                    
                                       <button type='submit'>Supprimer</button>
                                       </form>
                                   </div>");

echo $appwebpage->toHTML();
