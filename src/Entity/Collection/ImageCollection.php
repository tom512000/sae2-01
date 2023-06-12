<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Image;
use PDO;

class ImageCollection
{
    /**
     * Méthode permettant de retourner tous les albums d'un artiste.
     *
     * @param int $PosterId
     * @return string
     */
    public static function findByPosterId(int $PosterId): string
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, jpeg
            FROM image
            WHERE id = :PosterId
        SQL
        );
        $stmt->execute([":PosterId" => $PosterId]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Image::class);
        return $stmt->fetch();
    }
}
