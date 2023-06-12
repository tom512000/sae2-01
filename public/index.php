<?php

declare(strict_types=1);

use Entity\Collection\FilmCollection;
use Html\AppWebPage;

$appwebpage = new AppWebPage("Films");

$tab = FilmCollection::findAll();

for ($i = 0; $i < count($tab); $i++) {
    $verif = $appwebpage->escapeString($tab[$i]->getTitle());
    $appwebpage->appendContent("\t<a href='/film.php?artistId={$tab[$i]->getId()}'>
                                            <div class='affiche'>
                                                   <img src='' alt='Image'/><p>$verif</p>
                                            </div>
                                         </a><br>\n");
}

echo $appwebpage->toHTML();
