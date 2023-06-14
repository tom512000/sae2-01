<?php

declare(strict_types=1);

use Entity\Film;
use Entity\Genre;
use Html\AppWebPage;

$appwebpage = new AppWebPage("Films");

$appwebpage->appendContent("<div class='home'>
                    <select name='genre'>");

$genres = Genre::getGenres();
foreach ($genres as $genre) {
    $appwebpage->appendContent("
                        <option value='{$genre->getId()}'>{$genre->getName()}</option>");
}

$appwebpage->appendContent("
                    </select>
                    <a href='create.php'><img src='img/create.png' alt='Logo create'/></a>
                </div>");

$tab = Film::getFilms();

for ($i = 0; $i < count($tab); $i++) {
    $verif = $appwebpage->escapeString($tab[$i]->getTitle());
    $appwebpage->appendContent("
                <a class='lien' href='/film.php?filmId={$tab[$i]->getId()}'>
                    <div class='affiche'>
                        <img class='menu' src='./image.php?posterId={$tab[$i]->getPosterId()}' alt='Image'/>
                        <p>$verif</p>
                    </div>
                </a>");
}
echo $appwebpage->toHTML();
