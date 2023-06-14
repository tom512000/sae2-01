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
     * Accesseur à l'id du film. Retourne la valeur de l'id du film sous forme de nombre entier.
     *
     * @return int
     */
    public function getMovieId(): int
    {
        return $this->movieId;
    }

    /**
     * Modificateur à l'id du film. Permet d’affecter un nouvel id du film.
     *
     * @param int $movieId
     */
    public function setMovieId(int $movieId):void
    {
        $this->movieId = $movieId;
    }

    /**
     * Accesseur à l'id du genre. Retourne la valeur de l'id du genre sous forme de nombre entier.
     *
     * @return int
     */
    public function getGenreId(): int
    {
        return $this->genreId;
    }

    /**
     * Modificateur à l'id du genre. Permet d’affecter un nouvel id du genre.
     *
     * @param int $genreId
     */
    public function setGenreId(int $genreId):void
    {
        $this->genreId = $genreId;
    }

    /**
     * Méthode permettant de retourner tous les films de la table movie dans l'ordre.
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
