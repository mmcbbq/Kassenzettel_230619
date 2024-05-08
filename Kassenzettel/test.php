<?php

require_once '../vendor/autoload.php';
include '../Class/Artikel.php';
include '../Class/Kassenzettel.php';
include '../Class/Posten.php';
$kassenzettel = Kassenzettel::findAll();



$loader = new \Twig\Loader\FilesystemLoader('../view');
$twig = new \Twig\Environment($loader);


echo $twig->render('index.html.twig',['kassen'=> $kassenzettel]);