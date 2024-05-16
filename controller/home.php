<?php

use Model\repository\FilmDAO;
use Model\repository\ActeurDAO;


//On appelle la fonction getAll()
$filmDao = new FilmDAO();
$acteurDao = new ActeurDAO();

$films = $filmDao->getAll();


//On affiche le template Twig correspondant
echo $twig->render(
    'home.html.twig',
    [
        'films' => $films,


    ]
);
