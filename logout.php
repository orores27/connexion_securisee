<?php

// On crée un fichier qui est lié à la page home et qui nous permet de nous déconnecter au clic
session_start();
session_destroy();
// On demande la redirection vers la page home dès que l'on se déconnecte avec le ****location*****
header('Location: /index.php');
