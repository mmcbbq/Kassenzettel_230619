<?php
include '../Class/Artikel.php';
include '../Class/Kassenzettel.php';
include '../Class/Posten.php';


$kassenzettel = Kassenzettel::findById($_GET['id']);

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
<div>
    <?php echo $kassenzettel->getDatum()->format('d-m-Y H:i:s') ?>
</div>
<div>
    <?php
    foreach ($kassenzettel->getArtikelPos() as $artikelPo) {
        echo "<div>";
        echo $artikelPo->getAnzahl() . " " . $artikelPo->getArtikel()->getName() . ' ' . $artikelPo->getArtikel()->getMwstsatz() . ' ' . $artikelPo->getArtikel()->getPreis() . ' ' . $artikelPo->getgesamtPreis();
        echo "</div>";
    }
    ?>


</div>
<div><h1>
        <?php echo $kassenzettel->gesamtBetrag()?>
    </h1>
</div>
<div><h1>
        <?php echo $kassenzettel->getmwst7()?>
    </h1>
</div>
<div><h1>
        <?php echo $kassenzettel->getmwst19()?>
    </h1>
</div>

<div><a href="update.php?id=<?php echo $kassenzettel->getId()?>"><button>update</button></a>


</body>
</html>
