<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\FilmCollection;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Film
{
    private int $id;
    private int $posterId;
    private string $originalLanguage;
    private string $originalTitle;
    private string $overview;
    private string $releaseDate;
    private int $runtime;
    private string $tagline;
    private string $title;

    /**
     * Accesseur à l'id du film. Retourne la valeur de l'id sous forme de nombre entier.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Modificateur à l'id du film. Permet d’affecter un nouvel id du film.
     *
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Accesseur à l'id du poster du film. Retourne la valeur de l'id du poster sous forme de nombre entier.
     *
     * @return int
     */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    /**
     * Modificateur à l'id du poster du film. Permet d’affecter un nouvel id du poster du film.
     *
     * @param int $posterId
     */
    public function setPosterId(int $posterId): void
    {
        $this->posterId = $posterId;
    }

    /**
     * Accesseur à la langue d'origine du film. Retourne la valeur de la langue d'origine sous forme de chaîne de caractères.
     *
     * @return string
     */
    public function getOriginalLanguage(): string
    {
        return $this->originalLanguage;
    }

    /**
     * Modificateur à la langue d'origine du film. Permet d’affecter une nouvelle langue d'origine du film.
     *
     * @param string $originalLanguage
     */
    public function setOriginalLanguage(string $originalLanguage): void
    {
        $this->originalLanguage = $originalLanguage;
    }

    /**
     * Accesseur au titre d'origine du film. Retourne la valeur du titre d'origine sous forme de chaîne de caractères.
     *
     * @return string
     */
    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    /**
     * Modificateur au titre d'origine du film. Permet d’affecter un nouveau titre d'origine du film.
     *
     * @param string $originalTitle
     */
    public function setOriginalTitle(string $originalTitle): void
    {
        $this->originalTitle = $originalTitle;
    }

    /**
     * Accesseur à la description du film. Retourne la valeur de la description sous forme de chaîne de caractères.
     *
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * Modificateur à la description du film. Permet d’affecter une nouvelle description du film.
     *
     * @param string $overview
     */
    public function setOverview(string $overview): void
    {
        $this->overview = $overview;
    }

    /**
     * Accesseur à la date de sortie du film. Retourne la valeur de la date de sortie sous forme de chaîne de caractères.
     *
     * @return string
     */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
     * Modificateur à la date de sortie du film. Permet d’affecter une nouvelle date de sortie du film.
     *
     * @param string $releaseDate
     */
    public function setReleaseDate(string $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    /**
     * Accesseur au temps du film. Retourne la valeur du temps sous forme de nombre entier.
     *
     * @return int
     */
    public function getRuntime(): int
    {
        return $this->runtime;
    }

    /**
     * Modificateur au temps du film. Permet d’affecter un nouveau temps du film.
     *
     * @param int $runtime
     */
    public function setRuntime(int $runtime): void
    {
        $this->runtime = $runtime;
    }

    /**
     * Accesseur au slogan du film. Retourne la valeur du slogan sous forme de chaîne de caractères.
     *
     * @return string
     */
    public function getTagline(): string
    {
        return $this->tagline;
    }

    /**
     * Modificateur au slogan du film. Permet d’affecter un nouveau slogan du film.
     *
     * @param string $tagline
     */
    public function setTagline(string $tagline): void
    {
        $this->tagline = $tagline;
    }

    /**
     * Accesseur au titre du film. Retourne la valeur du titre sous forme de chaîne de caractères.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Modificateur au titre du film. Permet d’affecter un nouveau titre du film.
     *
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Méthode permettant de retourner tous les films de la table movie sous forme de liste.
     *
     * @return array
     */
    public static function getFilms(): array
    {
        return FilmCollection::findAll();
    }

    /**
     * Méthode permettant de retouner un film grâce à son id.
     *
     * @param int $id
     * @return Film
     */
    public static function findById(int $id): Film
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT id, posterId, originalLanguage, originalTitle, overview, releaseDate, runtime, tagline, title
                FROM movie
                WHERE id = :id
        SQL
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS, Film::class);
        $stmt->execute([":id" => $id]);
        $test = $stmt->fetch();
        if (!$test) {
            return throw new EntityNotFoundException();
        } else {
            return $test;
        }
    }

    /**
     * Méthode permettant de modifier une ligne dans la base de données.
     */
    public function editBDD(int $posterId, string $originalLanguage, string $originalTitle, string $overview, string $releaseDate, int $runtime, string $tagline, string $title): void
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
        UPDATE movie
        SET posterId = :posterId,
            originalLanguage = :originalLanguage,
            originalTitle = :originalTitle,
            overview = :overview,
            releaseDate = :releaseDate,
            runtime = :runtime,
            tagline = :tagline,
            title = :title
        WHERE id = :id
        SQL
        );
        $stmt->bindValue(':posterId', $posterId);
        $stmt->bindValue(':originalLanguage', $originalLanguage);
        $stmt->bindValue(':originalTitle', $originalTitle);
        $stmt->bindValue(':overview', $overview);
        $stmt->bindValue(':releaseDate', $releaseDate);
        $stmt->bindValue(':runtime', $runtime);
        $stmt->bindValue(':tagline', $tagline);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':id', $this->getId());
        $stmt->execute();
    }

    /**
     * Méthode permettant d'ajouter une ligne dans la base de données.
     */
    public static function createBDD(int $filmId, int $posterId, string $originalLanguage, string $originalTitle, string $overview, string $releaseDate, int $runtime, string $tagline, string $title): void
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
        INSERT INTO movie (id, posterId, originalLanguage, originalTitle, overview, releaseDate, runtime, tagline, title)
        VALUES (:id, :posterId, :originalLanguage, :originalTitle, :overview, :releaseDate, :runtime, :tagline, :title)
        SQL
        );
        $stmt->bindValue(':id', $filmId);
        $stmt->bindValue(':posterId', $posterId);
        $stmt->bindValue(':originalLanguage', $originalLanguage);
        $stmt->bindValue(':originalTitle', $originalTitle);
        $stmt->bindValue(':overview', $overview);
        $stmt->bindValue(':releaseDate', $releaseDate);
        $stmt->bindValue(':runtime', $runtime);
        $stmt->bindValue(':tagline', $tagline);
        $stmt->bindValue(':title', $title);
        $stmt->execute();
    }

    /**
     * Méthode permettant de supprimer une ligne dans la base de données.
     */
    public function deleteBDD(int $filmId)
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
        DELETE FROM movie
        WHERE id = :id
        SQL
        );

        $stmt->bindValue(':id', $filmId);
        $stmt->execute();
    }
}
