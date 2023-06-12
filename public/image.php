<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Entity\Image;

try {
    if (empty($_GET['posterId'])) {
        header('Content-Type: image/png');
        echo file_get_contents('img/default.png');
        exit();
    }
    if (!ctype_digit($_GET['posterId'])) {
        throw new ParameterException("Mauvais type");
    }
    if (isset($_GET['posterId']) && !empty($_GET['posterId']) && ctype_digit($_GET['posterId'])) {
        $posterId = intval($_GET['posterId']);
    }
    $poster = Image::findById($posterId);
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}

header('Content-Type: image/jpeg');
echo $poster->getJpeg();
