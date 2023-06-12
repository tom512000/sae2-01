<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Film;
use PDO;

class FilmCollection
{
    /**
     * Méthode permettant de retourner tous les films de la table movie.
     *
     * @return Film[]
     */
    public static function findAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, posterId, originalLanguage, originalTitle, overview, releaseDate, runtime, tagline, title
            FROM movie
            ORDER BY title
        SQL
        );
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Film::class);
        return $stmt->fetchAll();
    }
}
