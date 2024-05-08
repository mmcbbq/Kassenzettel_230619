<?php
include '../Class/Artikel.php';
$artikel = Artikel::findOneById($_GET['id']) ;
$artikel->delete($artikel);
echo 'deleted';
header( "refresh:2;url=show.php" );
exit();


