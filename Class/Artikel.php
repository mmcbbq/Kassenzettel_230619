<?php

class Artikel
{
    private int $id;
    private string $name;
    private float $preis;
    private int $mwstsatz;

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
    public function setName(string $name): void
    {
        $this->name = $name;
        $this->update();
    }

    /**
     * @return int
     */
    public function getPreis(): float
    {
        return $this->preis;

    }

    /**
     * @param int $preis
     */
    public function setPreis(float $preis): void
    {
        $this->preis = $preis;
        $this->update();

    }

    /**
     * @return int
     */
    public function getMwstsatz(): int
    {
        return $this->mwstsatz;
    }

    /**
     * @param int $mwstsatz
     */
    public function setMwstsatz(int $mwstsatz): void
    {
        $this->mwstsatz = $mwstsatz;
        $this->update();

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }




    public static function db_conn(): PDO
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "kassenzettel";
        return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    }

    /**
     * @return Artikel[]|false
     */
    public static function findAll()
    {
        $conn = self::db_conn();
        $sql = 'SELECT * FROM artikel';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Artikel');
    }

    public static function findOneById(int $id): Artikel
    {
        $conn = self::db_conn();
        $sql = 'SELECT * FROM artikel where id=:id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchObject('Artikel');
    }

    public static function create(string $name, float $preis, int $mwst): Artikel
    {
        $conn = self::db_conn();
        $sql = 'INSERT INTO artikel (name, preis, mwstsatz) VALUES (:name, :preis, :mwst)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':preis', $preis);
        $stmt->bindParam(':mwst', $mwst);
        $stmt->execute();
        return self::findOneById($conn->lastInsertId());

    }

    private function update(): bool
    {
        $conn = self::db_conn();
        $sql = 'UPDATE artikel SET name=:name, preis=:preis, mwstsatz=:mwst where id=:id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':preis', $this->preis);
        $stmt->bindParam(':mwst', $this->mwstsatz);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public function delete(Artikel &$user): bool
    {
        $conn = self::db_conn();
        $sql = 'DELETE FROM artikel where id=:id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $user->id);
        $user = null;
        return $stmt->execute();
    }
}