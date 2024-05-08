<?php
include '../Class/Artikel.php';
include '../Class/Kassenzettel.php';
include '../Class/Posten.php';
$kassenzettel = Kassenzettel::findAll();

foreach ($kassenzettel as $item) {
    echo '<div>';
    echo $item->getId().' '.$item->getDatum()->format('d-m-Y H:i:s');
    echo '<div><a href="show.php?id='.$item->getId().'"><button>show</button></a>';
    echo '<div><a href="deleteKassen.php?id='.$item->getId().'"><button>delete</button></a>';
    echo '</div>';
}