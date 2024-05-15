<?php

$userLoggedIn = isset($_SESSION['user']);

// Charge le template Twig en lui passant la variable userLoggedIn
echo $twig->render('header.html.twig', ['userLoggedIn' => $userLoggedIn]);
?>
