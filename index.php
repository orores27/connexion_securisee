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
if (isset($_POST['email']) && $_POST['email'] !== "") {
    $email = strip_tags($_POST['email']);
    $password = md5(strip_tags(($_POST['password'])));
/**
 * selectionner tout depuis la table user où email correspond à email et mdp correspond à password
 */
    $sqlQuery = 'SELECT * FROM users WHERE email = :email AND mdp = :password';
    $usersStatement = $db->prepare($sqlQuery);
    $usersStatement->execute([
        'email' => $email,
        'password' => $password,
    ]);
    $user = $usersStatement->fetch();
    if($user) {
        $_SESSION['user'] = $user;
        $_SESSION['error'] = "";
        header('Location: /employes.php');
    }else{
        $_SESSION['error'] = 'Les identifiants sont incorrects.';
        $_SESSION['user'] = "";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Dans la session, y-a-t'il un message d'erreur, si oui l'afficher sinon on n'affiche rien -->
<?= isset($_SESSION['error']) && $_SESSION['error'] !== "" ? $_SESSION['error'] : "" ?>

    <form action="" method="post">
        <label for="email"></label>
        <input type="email" id="email" name="email">
        <label for="password"></label>
        <!-- Explication du pattern : 
        (?=<CONDITION1>)(?=<CONDITION2>)(?=<CONDITION3>)<REGEX>
                 (?=.[A-Z])(?=.[a-z]) === doit contenir au moins une majuscule et une minuscule
                (?=.\d)(?=.[-+!*$@%]) === doit contenir au moins un chiffre
                 ([-+!*$@%_\w]{8,15}) === doit contenir au moins un caractère spécial
                -->
        <input type="password" id="password" name="password" title="Mot de passe au format de - de 8 à 15 caractères
    - au moins une lettre minuscule
    - au moins une lettre majuscule
    - au moins un chiffre
    - au moins un de ces caractères spéciaux: $ @ % * + -  !
    - aucun autre caractère possible: pas de & ni de {" pattern="(?=.[A-Z])(?=.[a-z])(?=.\d)(?=.[-+!*$@%])([-+!*$@%_\w]{8,15})" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">

        <button type="submit">Se connecter</button>
    </form>
    <a href="employes.php">Page employés</a>

</body>

</html>