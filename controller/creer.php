<?php
use Model\entity\Film;
use Model\entity\Acteur;
use Model\entity\Role;
use Model\repository\FilmDAO;
use Model\repository\ActeurDAO;
require_once __DIR__ . '/../config/init.php';
$message=null;
$film=null;

if(isset($_POST['titre']) && isset($_POST['annee']) && isset($_POST['affiche']) && isset($_POST['realisateur']) ){
    $titre = $_POST['titre'];
    $annee = $_POST['annee'];
    $affiche = $_POST['affiche'];
    $realisateur = $_POST['realisateur'];
    // $genre = $_POST['genre'];
    $filmDao = new FilmDAO();
    $film = new Film(null,$_POST['titre'],$_POST['realisateur'],$_POST['affiche'],$_POST['annee']);
    $status = $filmDao::addOne($film);
    $message = $status ? "Ajout OK" : "Erreur Ajout";
}
echo $twig->render('creer.html.twig', [
    'message' => $message
]);
