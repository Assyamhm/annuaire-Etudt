<?php
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch ($action) {
    case 'demandeConnexion':
    {
        include'views/v_menu.php';
        include("views/v_connexion.php");
        break;
    }
    case 'valideConnexion':
    {
        $login = $_REQUEST['login'];
        $mdp = $_REQUEST['mdp'];
        $visiteur = $pdo->getInfosVisiteur($login, $mdp);
        if (!is_array($visiteur)) {
            include("views/404.php");
            include("views/v_connexion.php");
        } else {
            $login = $visiteur['login'];
            $mdp = $visiteur['mdp'];
            connecter($login,$mdp);
           
            include 'views/v_accueil.php';
        }
        break;
    }
    case 'deconnexion':
    {
        deconnecter();
        break;
    }
    default :
    {
        include("views/v_connexion.php");
        break;
    }
}