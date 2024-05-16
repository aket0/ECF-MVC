<?php
use Model\entity\Film;
use Model\entity\Acteur;
use Model\entity\Role;
use Model\repository\FilmDAO;
use Model\repository\ActeurDAO;
require_once __DIR__ . '/../config/init.php';
$message=null;
$film=null;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['titre']) && isset($_POST['annee']) && isset($_POST['affiche']) && isset($_POST['realisateur']) ){
        //récupérer les $_POST
        $titre = $_POST['titre'];
        $annee = $_POST['annee'];
        $affiche = $_POST['affiche'];
        $realisateur = $_POST['realisateur'];

        $personnage=$_POST['personnage'];
        // $personnage = $_POST['personnage'];
        
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $liste = array();

        //récupération des roles dans un array
        for ($i = 0; $i < count($personnage); $i++) {
            $liste[$i] = array($personnage[$i], $nom[$i], $prenom[$i]);
        }
      
               // echo $liste[0][1];
        
        // var_dump($roles);

    $filmDao = new FilmDAO();
    $acteurDao = new ActeurDAO();
    //décalaration
    $film = new Film(null,$titre,$realisateur,$affiche,$annee);
    //vérifier si le film existe
    $film_exist=$filmDao::getOneByTitre($titre, $annee);
    if(!empty($film_exist)){
        // var_dump($film_exist);
        $message = "Le film existe déja sur la base de données";

    }
    else{
    
        //création du film 

        $id_film = $filmDao::addOneFilm($film);
        $film->setId($id_film);
        //boucler sur ma liste pour vérifier si l'acteur exixte ou pas 
        foreach ($liste as $elements) {
            $acteur=$acteurDao::getActeurByName($elements[1],$elements[2]);

            if(empty($acteur)){
                echo $elements[0] ." ..".$elements[1];
                $acteur= new Acteur(null, $elements[1],$elements[2]);
                $id_acteur=$acteurDao::addOneActeur($acteur);
                $acteur->setId($id_acteur);
                $role= new Role($acteur, $id_film ,random_int(50, 999),$elements[0]);
                $test=$filmDao::addOneRole($role);
            } 


        }

        $message="Votre film a été bien ajouter";
    }
    //vérifier si l'acteur existe dans la table

    
   
     

   

    

   
// 
}
}

echo $twig->render('creer.html.twig', [
    'message' => $message
]);
