<?php
include '../Class/Artikel.php';
include '../Class/Kassenzettel.php';
include '../Class/Posten.php';


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    var_dump($_POST);
    foreach ($_POST['id'] as $index => $aId) {
        $pos = Posten::findOneById($aId);
        $pos->update($_POST['anzahl'][$index],$_POST["aId"][$index]);
    }
} else {
    $kassen = Kassenzettel::findById($_GET['id']);


    ?>


    <!doctype html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport'
              content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <title>Document</title>
    </head>
    <body>
    <form action='update.php' method='post'>
        <?php
        foreach ($kassen->getArtikelPos() as $artikelPos) {
            ?>
            <div>
                <div><?php echo $artikelPos->getArtikel()->getName() ?></div>
                <input type='number' name='aId[]' value='<?php echo $artikelPos->getArtikel()->getId() ?>'>
                <input type='number' name='anzahl[]' value='<?php echo $artikelPos->getAnzahl() ?>'>
                <input type='hidden' name='id[]' value='<?php echo $artikelPos->getId() ?>'>
            </div>
            <?php
        }
        ?>
        <input type='submit' value='Save'>
    </form>

    </body>
    </html>
<?php }; ?>