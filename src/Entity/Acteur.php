<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Acteur
{
    private int $id;
    private int $avatarId;
    private ?string $birthday;
    private ?string $deathday;
    private string $name;
    private string $biography;
    private string $placeOfBirth;

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
    public function getAvatarId(): int
    {
        return $this->avatarId;
    }

    /**
     * @param int $avatarId
     */
    public function setAvatarId(int $avatarId):void
    {
        $this->avatarId = $avatarId;
    }

    /**
     * @return string
     */
    public function getBirthday(): string
    {
        return $this->birthday;
    }

    /**
     * @param string $birthday
     */
    public function setBirthday(string $birthday):void
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string
     */
    public function getDeathday(): string
    {
        return $this->deathday;
    }

    /**
     * @param string $deathday
     */
    public function setDeathday(string $deathday):void
    {
        $this->deathday = $deathday;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name):void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getBiography(): string
    {
        return $this->biography;
    }

    /**
     * @param string $biography
     */
    public function setBiography(string $biography):void
    {
        $this->biography = $biography;
    }

    /**
     * @return string
     */
    public function getPlaceOfBirth(): string
    {
        return $this->placeOfBirth;
    }

    /**
     * @param string $placeOfBirth
     */
    public function setPlaceOfBirth(string $placeOfBirth):void
    {
        $this->placeOfBirth = $placeOfBirth;
    }

    /**
     * Méthode permettant de retouner un acteur grâce à son id.
     * @param int $id
     * @return Acteur
     */
    public static function findById(int $id): Acteur
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT id, COALESCE(avatarId, 0) AS avatarId, birthday, deathday, name, biography, placeOfBirth
                FROM people
                WHERE id = :id
        SQL
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS, Acteur::class);
        $stmt->execute([":id" => $id]);
        $test = $stmt->fetch();
        if (!$test) {
            return throw new EntityNotFoundException();
        } else {
            return $test;
        }
    }
}
