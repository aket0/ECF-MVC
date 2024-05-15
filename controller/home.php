<?php

use Model\repository\FilmDAO;
use Model\repository\ActeurDAO;


//On appelle la fonction getAll()
$filmDao = new FilmDAO();
$acteurDao = new ActeurDAO();

$films = $filmDao->getAll();
$rolesByFilm = [];

// Boucle sur chaque film pour récupérer les rôles associés
foreach ($films as $film) {
    // Récupérer les rôles associés à ce film en utilisant son identifiant
    $roles = $filmDao->getRolesByFilm($film->getId());


    // Stocker les rôles dans le tableau associatif avec l'identifiant du film comme clé
    $rolesByFilm[$film->getId()] = $roles;
}
var_dump($rolesByFilm);
unset($_SESSION['user']);
// $_SESSION['user'] = 'vince@afpa.com';

//On affiche le template Twig correspondant
echo $twig->render(
    'home.html.twig',
    [
        'films' => $films,
        'rolesByFilm' => $rolesByFilm,

    ]
);
