<?php
session_start();
$db = new PDO(
    'mysql:host=localhost;dbname=users;charset=utf8',
    'root',
    'root'
);

if (isset($_SESSION['user']) && $_SESSION['user'] !== "") {

    $sqlQuery = 'SELECT * FROM users';
    $usersStatement = $db->query($sqlQuery);
    $users = $usersStatement->fetchAll();
}   else {
    $_SESSION['error'] = 'Accès refusé. Merci de vous connecter de nouveau.';
    header('Location: /index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employés</title>
</head>
<body>
    <ul>
        <?php foreach($users as $user):?>
            <li><?= 'Nom d\'utilisateur : '. $user['pseudo']. 'Adresse email : '. $user['email']. "Poste occupé : ". $user['poste'] ?> </li>
            <?php endforeach ?>
    </ul>
    <a href="index.php">Retour à la page d'accueil</a>
    <a href="logout.php">Déconnexion</a>
</body>
</html>