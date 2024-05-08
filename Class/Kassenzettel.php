<?php

class Kassenzettel
{

    private int $id;
    private DateTime $datum;


    public static function db_conn(): PDO
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "kassenzettel";
        return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    }


    public function __construct(int $id, string $datum)
    {
        $this->id = $id;
        $this->datum = new DateTime($datum);
    }

    public static function findById(int $id): Kassenzettel
    {
        $conn = self::db_conn();
        $sql = 'SELECT * FROM kassenzettel WHERE id=:id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(2);

        return new Kassenzettel($result['id'], $result['datum']);
    }

    /**
     * @return Kassenzettel[]
     */
    public static function findAll()
    {
        $conn = self::db_conn();
        $sql = 'SELECT * FROM kassenzettel';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(2);
        $kArrray = [];
        foreach ($result as $item) {
            $kArrray[] = new Kassenzettel($item['id'], $item['datum']);
        }
        return $kArrray;

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getDatum(): DateTime
    {
        return $this->datum;
    }

    /**
     * @return Posten[]
     */
    public function getArtikelPos(): array
    {
        return Posten::findAllbyKassenId($this->id);
    }

    public function gesamtBetrag(): float
    {
        $sum = 0;
        foreach ($this->getArtikelPos() as $artikel) {
            $sum += $artikel->getgesamtPreis();
        }
        return $sum;
    }

    public function getmwst7(): float
    {
        $sum = 0;
        foreach ($this->getArtikelPos() as $artikel) {
            if ($artikel->getArtikel()->getMwstsatz() == 7) {
                $sum += $artikel->mwstBetrag();
            }
        }
        return $sum;
    }
    public function getmwst19(): float
    {
        $sum = 0;
        foreach ($this->getArtikelPos() as $artikel) {
            if ($artikel->getArtikel()->getMwstsatz() == 19) {
                $sum += $artikel->mwstBetrag();
            }
        }
        return $sum;
    }

    public function delete(Kassenzettel &$kassen)
    {
        $conn = self::db_conn();
        $sql = 'DELETE FROM kassenzettel where id=:id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $kassen->id);
        $kassen = null;
        return $stmt->execute();
    }


    public static function create(array $pos)
    {
        $conn = self::db_conn();
        $sql = 'INSERT INTO kassenzettel(datum) values (:datum)';
        $stmt = $conn->prepare($sql);
        $datestring = new DateTime('now');
        $datestring = $datestring->format('Y-m-d-H:i:s');
        $stmt->bindParam(':datum', $datestring);
        $stmt->execute();
        for ($i = 0; $i < count($pos['anzahl']); $i++) {
            Posten::create($pos['anzahl'][$i], $conn->lastInsertId(), $pos["aId"][$i]);

        }
    }
}