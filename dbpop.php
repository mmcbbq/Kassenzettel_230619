<?php
require_once "vendor/autoload.php";

//faker-Objekt erstellen und einen Provider hinzufügen
$faker = Faker\Factory::create("de_DE");
$faker->seed(1000);
$faker->addProvider(new Bezhanov\Faker\Provider\Commerce($faker));
// Datenbankverbindung
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kassenzettel";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


$sql = 'INSERT INTO kassenzettel (datum) values (:datum)';
$stmt = $conn->prepare($sql);

for ($i = 0; $i < 20; $i++) {
    $fakedate = $faker->dateTimeBetween('-2 years')->format('Y-m-d-H:i:s');
    $stmt->bindParam(":datum",$fakedate);
    $stmt->execute();
}
$sql = 'INSERT INTO artikel (name, preis, mwstsatz) VALUES (:name, :preis,:mwst)';
$stmt = $conn->prepare($sql);

for ($j = 0; $j < 100; $j++) {
    $fakepreis = $faker->randomFloat(2,0.50,200);
    $fakename = $faker->productName();
    $fakemwst = $faker->randomElement([7,19]);

    $stmt->bindParam(':name',$fakename);
    $stmt->bindParam(':preis',$fakepreis);
    $stmt->bindParam(':mwst',$fakemwst);
    $stmt->execute();
}


$sql = 'INSERT INTO kassen_artikel (anzahl, kassenzettel_id, artikel_id) VALUES (:anzahl, :kassenzettel_id, :artikel_id)';
$stmt = $conn->prepare($sql);
for ($k = 1; $k < 21; $k++) {
    $kassenid = $k;
    $randompositionen = $faker->numberBetween(1,30);
    for ($l = 0; $l <$randompositionen ; $l++) {
        $anzahl = $faker->numberBetween(1,10);
        $fakeartikelid= $faker->numberBetween(1,100);
        $stmt->bindParam(':anzahl',$anzahl);
        $stmt->bindParam(':kassenzettel_id',$kassenid);
        $stmt->bindParam(':artikel_id',$fakeartikelid);
        $stmt->execute();
    }
}




