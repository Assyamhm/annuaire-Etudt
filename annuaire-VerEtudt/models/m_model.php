<?php

class PdoBridge
{
    private static string $serveur = 'mysql:host=localhost';
    private static string $bdd = 'dbname=annuaire';
    private static string $user = 'root';
    private static string $mdp = '';
    private static $monPdoBridge = null;
    /**
     * @var PDO   <--- need by PhpStorm to find Methods of PDO
     */
    private static PDO $monPdo;

    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
    private function __construct()
    {
        PdoBridge::$monPdo = new PDO(PdoBridge::$serveur . ';' . PdoBridge::$bdd, PdoBridge::$user, PdoBridge::$mdp);
        PdoBridge::$monPdo->query("SET CHARACTER SET utf8");
    }

    public function _destruct()
    {
        PdoBridge::$monPdo = null;
    }

    /**
     * Fonction statique qui crée l'unique instance de la classe
     *
     * Appel : $instancePdolafleur = PdoBridge::getPdoBridge();
     * @return l'unique objet de la classe PdoBridge
     */
    public static function getPdoBridge()
    {
        if (PdoBridge::$monPdoBridge == null) {
            PdoBridge::$monPdoBridge = new PdoBridge();
        }
        return PdoBridge::$monPdoBridge;
    }

    

    public function getInfosVisiteur($login, $mdp){
        $req = "select login, mdp from connexionvisiteur where login='$login' and mdp='$mdp'";
        $rs = PdoBridge::$monPdo->query($req);
        $ligne = $rs->fetch();
        return $ligne;
    }
    public function getLeMembre($id){
        $req = "select nom, prenom from membres where id='$id'";
        $rs = PdoBridge::$monPdo->query($req);
        $ligne = $rs->fetch();
        return $ligne;
    }

    public function getLesMembres()
    {
        $sql = 'select id,nom,prenom from membres';
        $req = PdoBridge::$monPdo->prepare($sql);
        $req->execute();
        $d = $req->fetchALL(PDO::FETCH_ASSOC);
        return $d;
    }

    public function getMaxId()
    {
        // modifiez la requête sql (rajouter max)
        $req = "SELECT max(id) AS maxi FROM membres";
        $res = PdoBridge::$monPdo->query($req);
        $lesLignes = $res->fetch();
        return 1 + intval($lesLignes["maxi"]);
    }

    public function insertMembre($nom, $prenom)
    {
        // modifiez la requête sql
        $id = $this->getMaxId();
        // modifiez la requête sql (rajoutez nom,prenom)
        $sql = "INSERT INTO membres Value(:id, :nom, :prenom)";
        // modifiez la requête sql (modifier et mettre prepare)
        $req = PdoBridge::$monPdo->prepare($sql);
        // modifiez la requête sql (ajouter des requetes preparer (protèje les infos))
        $req->bindParam(':id',$id);
        $req->bindParam(':nom',$nom);
        $req->bindParam(':prenom',$prenom);

        $req->execute();
    }
 
    public function DelMembre($id)
    {
        $sql="DELETE FROM membres WHERE id='$id'";
        $req=PdoBridge :: $monPdo -> exec($sql);
    }

    public function ModifMembre($id,$prenom,$nom)
    {
        $sql="UPDATE membres set prenom= :prenom, nom=:nom where id=:id";
        $req= PdoBridge :: $monPdo -> prepare($sql);

        $req->bindParam(':id',$id);
        $req->bindParam(':nom',$nom);
        $req->bindParam(':prenom',$prenom);

        $req->execute();
        $membre = $req -> fetchAll();
        return $membre;

    }
}




