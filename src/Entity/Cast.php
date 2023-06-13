<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Cast
{
    private int $id;
    private int $movieId;
    private int $peopleId;
    private string $role;
    private int $orderIndex;

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
    public function setId(int $id):void
    {
        $this->id = $id;
    }

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
    public function getPeopleId(): int
    {
        return $this->peopleId;
    }

    /**
     * @param int $peopleId
     */
    public function setPeopleId(int $peopleId):void
    {
        $this->peopleId = $peopleId;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role):void
    {
        $this->role = $role;
    }

    /**
     * @return int
     */
    public function getOrderIndex(): int
    {
        return $this->orderIndex;
    }

    /**
     * @param int $orderIndex
     */
    public function setOrderIndex(int $orderIndex):void
    {
        $this->orderIndex = $orderIndex;
    }

    /**
     * Méthode permettant de retouner une liste de Cast grâce à un id de Film.
     * @param int $idFilm
     * @return Cast[]
     */
    public static function findByFilmId(int $idFilm): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT id, movieId, peopleId, role, orderIndex
                FROM cast
                WHERE movieId = :idFilm
        SQL
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS, Cast::class);
        $stmt->execute([":idFilm" => $idFilm]);
        $test = $stmt->fetchAll();
        if (!$test) {
            return throw new EntityNotFoundException();
        } else {
            return $test;
        }
    }

    /**
     * Méthode permettant de retouner une liste de Cast grâce à un id d'Acteur.
     * @param int $idActor
     * @return Cast[]
     */
    public static function findByActorId(int $idActor): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT id, movieId, peopleId, role, orderIndex
                FROM cast
                WHERE peopleId = :idActor
        SQL
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS, Cast::class);
        $stmt->execute([":idActor" => $idActor]);
        $test = $stmt->fetchAll();
        if (!$test) {
            return throw new EntityNotFoundException();
        } else {
            return $test;
        }
    }
}
