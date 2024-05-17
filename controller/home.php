<?php

use Model\repository\FilmDAO;
use Model\repository\ActeurDAO;


//On appelle la fonction getAll()
$filmDao = new FilmDAO();


$message =null;

if (isset($_POST['motCle'])) {
    $films = $filmDao::searchOne($_POST['motCle']);

    empty($films) ? $message="Aucun film correspendant à \"".$_POST['motCle']. " \"" : $message="Résultat(s) trouvé(s) :";
    
    
}
else {
    $films = $filmDao->getAll();
}
//On affiche le template Twig correspondant
echo $twig->render(
    'home.html.twig',
    [
        'films' => $films,
        'message' => $message


    ]
);
