<?php
switch ($action) {
    case 'accueil':
    {
        $message="Ce site permet d'enregistrer les participants à une épreuve.";
        include("views/v_accueil.php");
        break;
    }
    case 'lister': 
    {
        if(isset($_SESSION['login']))
        {
            $les_membres=$pdo->getLesMembres();
            require 'views/v_listemembres.php';
        }
        else 
        {
            include("views/v_connexion.php");
        }
        break;


    }


    case 'supprimer':
    {
        if(isset($_SESSION['login']))
        {
            $les_membres=$pdo->getLesMembres();
            include("views/v_SupressionMembre.php");
        }
        else 
        {
            include("views/v_connexion.php");
        }
        break;

        }

        case 'ValiderSupprimer':
            {
                if(isset($_POST['SUPMEM']) && !empty ($_POST['SUPMEM']))
                {
                    $SUPMEM=$_POST['SUPMEM'];
                    $pdo -> DelMembre($SUPMEM);
                    $message="le membre à bien été supprimer";
                    include("views/v_accueil.php");
                }
            break;
            }
            



    case 'saisir':
    {
        if(isset($_SESSION['login']))
        {
            include("views/v_saisie.php");
        }
        else 
        {
            include("views/v_connexion.php");
        }
        break;
       
    }
    case 'controlesaisie':
    {
        $nom = $_REQUEST['nom'];
        $prenom = $_REQUEST['prenom'];
        // affecter $prenom

        if (empty($nom) || empty($prenom)) 
        {
        require "views/v_saisie.php";
        } 
        
        else 
        {
            $resultat = $pdo->insertMembre($nom, $prenom);
            $message="le membre $nom, $prenom a été ajouté(e)";
            include("views/v_accueil.php");

        }
        break;

    }

    case 'modifier':
    {
        if(isset($_SESSION['login']))
        {
            $les_membres=$pdo->getLesMembres();
            include("views/v_Modifier.php");
        }
        else 
        {
            include("views/v_connexion.php");
        }
        break;
    }
    
    case 'afficherModifier':
    {
        $_SESSION['id'] = $_REQUEST['id'];
        $id=$_REQUEST['id'];
        $leMembre =$pdo -> getLeMembre($id);
        include("views/v_afficherModifier.php");
        break;
    }

    case 'ValiderModifier':
    {
        $id=$_SESSION['id'];
        $nom=$_REQUEST['nom'];
        $prenom=$_REQUEST['prenom'];
        $modif =$pdo -> ModifMembre($id,$prenom,$nom);
        $les_membres=$pdo -> getLesMembres();
        $message="le membre a bien été supprimé";
        include("views/v_listemembres.php");
        break;
    }

    default:
    {
        $_SESSION["message_erreur"] = "Site en construction";
        include("views/404.php");
        break;
    }

}
