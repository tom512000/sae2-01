<?php

declare(strict_types=1);

use Entity\Film;
use Html\AppWebPage;

$appwebpage = new AppWebPage();

$appwebpage->setTitle("Création d'un film");

$appwebpage->appendContent("<div class='form'>
                                       <form method='POST' action='modifier_film.php'>
                                       <label for='filmId'>ID du film :</label>
                                       <input type='text' name='filmId' value=''>
                                    
                                       <label for='posterId'>ID de l'affiche :</label>
                                       <input type='text' name='posterId' id='posterId' value=''>

                                       <label for='originalLanguage'>Langue originale :</label>
                                       <input type='text' name='originalLanguage' id='originalLanguage' value=''>

                                       <label for='originalTitle'>Titre original :</label>
                                       <input type='text' name='originalTitle' id='originalTitle' value=''>

                                       <label for='overview'>Synopsis :</label>
                                       <textarea name='overview' id='overview'></textarea>

                                       <label for='releaseDate'>Date de sortie :</label>
                                       <input type='text' name='releaseDate' id='releaseDate' value=''>

                                       <label for='runtime'>Durée :</label>
                                       <input type='text' name='runtime' id='runtime' value=''>

                                       <label for='tagline'>Accroche :</label>
                                       <input type='text' name='tagline' id='tagline' value=''>

                                       <label for='title'>Titre :</label>
                                       <input type='text' name='title' id='title' value=''>

                                       <button type='submit'>Créer</button>
                                       </form>
                                   </div>");

echo $appwebpage->toHTML();
