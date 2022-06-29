<?php 
session_start();
$db = new PDO(
    //  on donne le nom de l'hôte, de la base
    'mysql:host=localhost;dbname=users;charset=utf8',
    'root',
    'root'
);

/**
 * Crypter un mdp avec ***md5***
 */
if (isset($_SESSION['user']) && $_SESSION['user'] !== "") {
   
/**
 * selectionner tout depuis la table user où email correspond à email et mdp correspond à password
 */
    $sqlQuery = 'SELECT * FROM users';
    $usersStatement = $db->query($sqlQuery);
    $users = $usersStatement->fetchAll();
}   else {
    $_SESSION['error'] = "Accès non autorisé. Merci de vous connecter.";
    header('Location: /index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employé</title>
</head>
<body>
    <ul>
        <?php foreach($users as $user):?>
            
            <li><?= 'Nom d\'utilisateur : '. $user['pseudo']." Adresse email : ". $user['email']. " Poste occupé : ". $user['poste'] ?> </li>
            <?php endforeach ?>
    </ul>
    <a href="index.php">Retour à l'index</a>
    <a href="logout.php">Déconnexion</a>
</body>
</html>