<?php

use Model\entity\User;
use Model\repository\UserDAO;

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../view');
$twig = new \Twig\Environment($loader);
$twig->addGlobal('session', $_SESSION);
$userDAO = new UserDAO();

$register_error = null;
$login_error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form_type = $_POST['form_type'];

    if ($form_type === 'register') {
        // Handle registration
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];
    
        // Basic validation
        if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
            $register_error = 'All fields are required.';
        } elseif ($password !== $confirmPassword) {
            $register_error = 'Les mots de passe ne correspondent pas.';
        } else {
            // Check if email is already taken
            if (UserDAO::getByEmail($email)) {
                $register_error = 'Email already taken';
            } else {
                // Create a new user object and try to add it to the database
                $user = new User(null, $username, $email, password_hash($password, PASSWORD_DEFAULT)); // Hash the password
                if (UserDAO::addOne($user)) {
                    $_SESSION['user'] = $user;
                    header('Location: /ECF-MVC/?action=home');
                    exit;
                } else {
                    $register_error = "Erreur lors de l'inscription.";
                }
            }
        }
    } elseif ($form_type === 'login') {
        // Handle login
        $email = $_POST['login_email'];
        $password = $_POST['login_password'];

        $user = UserDAO::getByEmail($email);

        if ($user && password_verify($password, $user->getPassword())) {
            $_SESSION['user'] = $user;
            header('Location: /ECF-MVC/?action=home');
            exit;
        } else {
            $login_error = 'Email ou mot de passe incorrect.';
        }
    }
}

echo $twig->render('login.html.twig', [
    'register_error' => $register_error,
    'login_error' => $login_error,
]);
