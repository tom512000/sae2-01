<?php

declare(strict_types=1);

use Entity\Collection\FilmCollection;
use Html\AppWebPage;

$appwebpage = new AppWebPage("Films");

$tab = FilmCollection::findAll();

for ($i = 0; $i < count($tab); $i++) {
    $verif = $appwebpage->escapeString($tab[$i]->getTitle());
    $appwebpage->appendContent("\t<a href='/film.php?filmId={$tab[$i]->getId()}'>
                                            <div class='affiche'>
                                                   <img class='menu' src='./image.php?posterId={$tab[$i]->getPosterId()}' alt='Image'/>
                                                   <p>$verif</p>
                                            </div>
                                         </a><br>\n");
}
echo $appwebpage->toHTML();
