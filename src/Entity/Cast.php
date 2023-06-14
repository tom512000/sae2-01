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
     * Accesseur à l'id du cast. Retourne la valeur de l'id sous forme de nombre entier.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Modificateur à l'id du cast. Permet d’affecter un nouvel id au cast.
     *
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Accesseur à l'id du film du cast. Retourne la valeur de l'id du film sous forme de nombre entier.
     *
     * @return int
     */
    public function getMovieId(): int
    {
        return $this->movieId;
    }

    /**
     * Modificateur à l'id du film du cast. Permet d’affecter un nouvel id du film du cast.
     *
     * @param int $movieId
     */
    public function setMovieId(int $movieId): void
    {
        $this->movieId = $movieId;
    }

    /**
     * Accesseur à l'id de l'acteur du cast. Retourne la valeur de l'id de l'acteur sous forme de nombre entier.
     *
     * @return int
     */
    public function getPeopleId(): int
    {
        return $this->peopleId;
    }

    /**
     * Modificateur à l'id de l'acteur du cast. Permet d’affecter un nouvel id de l'acteur du cast.
     *
     * @param int $peopleId
     */
    public function setPeopleId(int $peopleId): void
    {
        $this->peopleId = $peopleId;
    }

    /**
     * Accesseur au rôle du cast. Retourne la valeur du rôle sous forme de chaîne de caractères.
     *
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Modificateur au rôle du cast. Permet d’affecter un nouveau rôle du cast.
     *
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * Accesseur à l'index d'ordre du cast. Retourne la valeur de l'index d'ordre sous forme de nombre entier.
     *
     * @return int
     */
    public function getOrderIndex(): int
    {
        return $this->orderIndex;
    }

    /**
     * Modificateur à l'index d'ordre du cast. Permet d’affecter un nouvel index d'ordre du cast.
     *
     * @param int $orderIndex
     */
    public function setOrderIndex(int $orderIndex): void
    {
        $this->orderIndex = $orderIndex;
    }

    /**
     * Méthode permettant de retouner une liste de Cast grâce à un id de Film.
     *
     * @param int $idFilm
     * @return array|null
     */
    public static function findByFilmId(int $idFilm): ?array
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
        return $stmt->fetchAll();
    }

    /**
     * Méthode permettant de retouner une liste de Cast grâce à un id d'Acteur.
     *
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
