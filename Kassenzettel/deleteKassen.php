<?php
include '../Class/Artikel.php';
include '../Class/Kassenzettel.php';
include '../Class/Posten.php';
$kassen = Kassenzettel::findById($_GET['id']) ;
$kassen->delete($kassen);
echo 'deleted';
header( "refresh:2;url=index.php" );
exit();
