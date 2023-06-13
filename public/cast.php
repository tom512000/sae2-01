<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Entity\Image;

try {
    if (empty($_GET['avatarId'])) {
        header('Content-Type: image/png');
        echo file_get_contents('img/actor.png');
        exit();
    }
    if (!ctype_digit($_GET['avatarId'])) {
        throw new ParameterException("Mauvais type");
    }
    if (isset($_GET['avatarId']) && !empty($_GET['avatarId']) && ctype_digit($_GET['avatarId'])) {
        $avatarId = intval($_GET['avatarId']);
    }
    $avatar = Image::findById($avatarId);
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}

header('Content-Type: image/jpeg');
echo $avatar->getJpeg();
