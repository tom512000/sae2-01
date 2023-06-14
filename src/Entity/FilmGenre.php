<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class FilmGenre
{
    private int $movieId;
    private int $genreId;

    /**
     * @return int
     */
    public function getMovieId(): int
    {
        return $this->movieId;
    }

    /**
     * @param int $movieId
     */
    public function setMovieId(int $movieId):void
    {
        $this->movieId = $movieId;
    }

    /**
     * @return int
     */
    public function getGenreId(): int
    {
        return $this->genreId;
    }

    /**
     * @param int $genreId
     */
    public function setGenreId(int $genreId):void
    {
        $this->genreId = $genreId;
    }

    /**
     * Méthode permettant de retourner tous les films de la table movie.
     *
     * @return FilmGenre[]
     */
    public static function sortByGenreId(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT movieId, genreId
            FROM movie_genre
        SQL
        );
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, FilmGenre::class);
        return $stmt->fetchAll();
    }
}
