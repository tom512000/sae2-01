<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    /**
     * @param int $posterId
     */
    public function setPosterId(int $posterId): void
    {
        $this->posterId = $posterId;
    }

    /**
     * @return string
     */
    public function getOriginalLanguage(): string
    {
        return $this->originalLanguage;
    }

    /**
     * @param string $originalLanguage
     */
    public function setOriginalLanguage(string $originalLanguage): void
    {
        $this->originalLanguage = $originalLanguage;
    }

    /**
     * @return string
     */
    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    /**
     * @param string $originalTitle
     */
    public function setOriginalTitle(string $originalTitle): void
    {
        $this->originalTitle = $originalTitle;
    }

    /**
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * @param string $overview
     */
    public function setOverview(string $overview): void
    {
        $this->overview = $overview;
    }

    /**
     * @return string
     */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
     * @param string $releaseDate
     */
    public function setReleaseDate(string $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return int
     */
    public function getRuntime(): int
    {
        return $this->runtime;
    }

    /**
     * @param int $runtime
     */
    public function setRuntime(int $runtime): void
    {
        $this->runtime = $runtime;
    }

    /**
     * @return string
     */
    public function getTagline(): string
    {
        return $this->tagline;
    }

    /**
     * @param string $tagline
     */
    public function setTagline(string $tagline): void
    {
        $this->tagline = $tagline;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Méthode permettant de retouner un film grâce à son id.
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
