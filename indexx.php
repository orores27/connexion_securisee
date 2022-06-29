<?php 
session_start();
$db = new PDO(
    'mysql:host=localhost;dbname=users;charset=utf8',
    'root',
    'root'
);

if (isset($POST['email']) && $_POST['email'] !== "") {
    $email = strip_tags($_POST['email']);
    $password = md5(strip_tags(($_POST['password'])));

    $sqlQuery = 'SELECT * FROM users WHERE email = :email AND mdp = :password';
    $userStatement = $db->prepare($sqlQuery);
    $userStatement ->execute([
        'email' => $email,
        'password' => $password,
    ]);
    $user = $userStatement->fetch();
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
    <title>Accueil</title>
</head>
<body>
    <?= isset($_SESSION['error']) && $_SESSION['error'] !== "" ? $_SESSION['error'] : "" ?>

    <form action="" method="post">
        <label for="email"></label>
        <input type="email" id="email" name="email">
        <label for="password">
        <input type="password" id="password" name="password">
        <button type="submit">Se connecter</button>
    </form>
    <a href="employes.php">Page des employés</a>

</body>

</html>