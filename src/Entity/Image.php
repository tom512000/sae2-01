<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Image
{
    private int $id;
    private string $jpeg;

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
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    /**
     * @param string $jpeg
     */
    public function setJpeg(string $jpeg):void
    {
        $this->jpeg = $jpeg;
    }

    /**
     * Méthode permettant de retourner le poster d'un Film grâce à son id.
     *
     * @param int $id
     * @return Image
     */
    public static function findById(int $id): Image
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, jpeg
            FROM image
            WHERE id = :id
        SQL
        );
        $stmt->execute([":id" => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Image::class);
        if (($res = $stmt->fetch()) === false) {
            throw new EntityNotFoundException("Pas de cover", 0);
        }
        return $res;
    }
}
