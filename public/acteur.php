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

echo $appwebpage->toHTML();
