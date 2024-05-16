<?php

use Model\entity\Film;
use Model\repository\FilmDAO;
require_once __DIR__ . '/../config/init.php';



// var_dump($_POST['motCle']);
// var_dump("Bonjour");


$offre = null; 


$filmDao = new FilmDAO();


if (isset($_POST['motCle'])) {
    $films = $filmDao::searchOne($_POST['motCle']);

    empty($films) ? $message="Aucun film correspendant à \"".$_POST['motCle']. " \"" : $message="Résultat(s) trouvé(s) :";
    
    
}
echo $twig->render('home.html.twig', [
    'films' => $films,
    'message' => $message
]);