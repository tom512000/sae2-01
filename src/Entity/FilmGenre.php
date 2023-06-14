<?php

declare(strict_types=1);

namespace Entity;

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
}
