<?php

declare(strict_types=1);

namespace Entity;

use Entity\Collection\GenreCollection;

class Genre
{
    private int $id;
    private string $name;

    /**
     * Accesseur à l'id du genre. Retourne la valeur de l'id sous forme de nombre entier.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Modificateur à l'id du genre. Permet d’affecter un nouvel id du genre.
     *
     * @param int $id
     */
    public function setId(int $id):void
    {
        $this->id = $id;
    }

    /**
     * Accesseur au nom du genre. Retourne la valeur du nom sous forme de chaine de caractères.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Modificateur au nom du genre. Permet d’affecter un nouveau nom du genre.
     *
     * @param string $name
     */
    public function setName(string $name):void
    {
        $this->name = $name;
    }

    /**
     * Méthode permettant de retourner tous les genres de la table genre sous forme de liste.
     *
     * @return array
     */
    public static function getGenres(): array
    {
        return GenreCollection::findAll();
    }
}
