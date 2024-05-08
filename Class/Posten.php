<?php

class Posten
{
    private int $id;
    private int $anzahl;
    private Artikel $artikel;

    /**
     * @param int $id
     * @param int $anzahl
     * @param Artikel $artikel
     */
    public function __construct(int $id, int $anzahl,  int $artikel_id)
    {
        $this->id = $id;
        $this->anzahl = $anzahl;
        $this->artikel = Artikel::findOneById($artikel_id);
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
     * @param int $id
     * @return Posten[]|bool
     */
    public static function findAllbyKassenId(int $id): array|bool
    {
        $conn = self::db_conn();
        $sql = 'SELECT * FROM kassen_artikel WHERE kassenzettel_id=:kassenzettelid';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':kassenzettelid', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(2);
        $kassPos = [];
        foreach ($result as $pos) {
            $kassPos[] = new Posten($pos['id'], $pos['anzahl'], $pos['artikel_id']);
        }
        return $kassPos;
    }

    /**
     * @param int $anzahl
     * @param int $k_id
     * @param int $a_id
     * @return Posten
     */
    public static function create(int $anzahl, int $k_id, int $a_id):Posten
    {
        $conn = self::db_conn();
        $sql = 'INSERT INTO kassen_artikel (anzahl, kassenzettel_id, artikel_id) VALUES (:anzahl, :k_id, :a_id)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':anzahl', $anzahl);
        $stmt->bindParam(':k_id', $k_id);
        $stmt->bindParam(':a_id', $a_id);
        $stmt->execute();
        return self::findOneById($conn->lastInsertId());

    }

    public static function findOneById(int $id):Posten
    {
        $conn = self::db_conn();
        $sql = 'SELECT * FROM kassen_artikel where id=:id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(2);
        return new Posten($result['id'],$result['anzahl'],$result['artikel_id']);
    }


    public function update($anzahl, $a_id):void
    {
        $conn = self::db_conn();
        $sql = 'UPDATE kassen_artikel SET anzahl=:anzahl, artikel_id=:a_id where id=:id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('anzahl',$anzahl);
        $stmt->bindParam('a_id',$a_id);
        $stmt->bindParam('id',$this->id);
        $stmt->execute();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getAnzahl(): int
    {
        return $this->anzahl;
    }

    /**
     * @return int
     */
    public function getKassenzettelId(): int
    {
        return $this->kassenzettel_id;
    }

    /**
     * @return Artikel
     */
    public function getArtikel(): Artikel
    {
        return $this->artikel;
    }

    public function getgesamtPreis():float
    {
        return $this->getAnzahl() * $this->artikel->getPreis();
    }

    public function mwstBetrag():float
    {
        return  ($this->getgesamtPreis() - ($this->getgesamtPreis() / (1+$this->artikel->getMwstsatz()/100)));

    }



}