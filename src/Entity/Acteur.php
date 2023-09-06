<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Acteur
{
    private int $id;
    private ?int $avatarId;
    private ?string $birthday;
    private ?string $deathday;
    private string $name;
    private string $biography;
    private string $placeOfBirth;

    /**
     * Accesseur à l'id de l'acteur. Retourne la valeur de l'id sous forme de nombre entier.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Modificateur à l'id de l'acteur. Permet d’affecter un nouvel id à l'acteur.
     *
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Accesseur à l'id de l'avatar de l'acteur. Retourne la valeur de l'id de l'avatar sous forme de nombre entier.
     *
     * @return int
     */
    public function getAvatarId(): ?int
    {
        return $this->avatarId;
    }

    /**
     * Modificateur à l'id de l'avatar de l'acteur. Permet d’affecter un nouvel id de l'avatar à l'acteur.
     *
     * @param int $avatarId
     */
    public function setAvatarId(int $avatarId): void
    {
        $this->avatarId = $avatarId;
    }

    /**
     * Accesseur à la date de naissance de l'acteur. Retourne la valeur de la date de naissance sous forme de chaîne de caractères.
     *
     * @return string
     */
    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    /**
     * Modificateur à la date de naissance de l'acteur. Permet d’affecter une nouvelle date de naissance à l'acteur.
     *
     * @param string $birthday
     */
    public function setBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * Accesseur à la date de mort de l'acteur. Retourne la valeur de la date de mort sous forme de chaîne de caractères.
     *
     * @return string
     */
    public function getDeathday(): ?string
    {
        return $this->deathday;
    }

    /**
     * Modificateur à la date de mort de l'acteur. Permet d’affecter une nouvelle date de mort à l'acteur.
     *
     * @param string $deathday
     */
    public function setDeathday(string $deathday): void
    {
        $this->deathday = $deathday;
    }

    /**
     * Accesseur au nom de l'acteur. Retourne la valeur du nom sous forme de chaîne de caractères.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Modificateur au nom de l'acteur. Permet d’affecter un nouveau nom à l'acteur.
     *
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Accesseur à la biographie de l'acteur. Retourne la valeur de la biographie sous forme de chaîne de caractères.
     *
     * @return string
     */
    public function getBiography(): string
    {
        return $this->biography;
    }

    /**
     * Modificateur à la biographie de l'acteur. Permet d’affecter une nouvelle biographie à l'acteur.
     *
     * @param string $biography
     */
    public function setBiography(string $biography): void
    {
        $this->biography = $biography;
    }

    /**
     * Accesseur au lieu de naissance de l'acteur. Retourne la valeur du lieu de naissance sous forme de chaîne de caractères.
     *
     * @return string
     */
    public function getPlaceOfBirth(): string
    {
        return $this->placeOfBirth;
    }

    /**
     * Modificateur au lieu de naissance de l'acteur. Permet d’affecter un nouveau lieu de naissance de l'acteur.
     *
     * @param string $placeOfBirth
     */
    public function setPlaceOfBirth(string $placeOfBirth): void
    {
        $this->placeOfBirth = $placeOfBirth;
    }

    /**
     * Méthode permettant de retouner un acteur grâce à son id.
     *
     * @param int $id
     * @return Acteur
     */
    public static function findById(int $id): Acteur
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT id, avatarId, birthday, deathday, name, biography, placeOfBirth
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
