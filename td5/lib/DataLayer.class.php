<?php
class DataLayer {
	// private ?PDO $conn = NULL; // le typage des attributs est valide uniquement pour PHP>=7.4

	private  $conn = NULL; // connexion de type PDO   compat PHP<=7.3
	
	/**
	 * @param $DSNFileName : file containing DSN 
	 */
	function __construct(string $DSNFileName){
		$dsn = "uri:$DSNFileName";
		$this->connexion = new PDO($dsn);
		// paramètres de fonctionnement de PDO :
		$this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // déclenchement d'exception en cas d'erreur
		$this->connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC); // fetch renvoie une table associative
		// réglage d'un schéma par défaut :
		$this->connexion->query('set search_path=authent');
	}
    
    
    function authentificationProvisoire(string $login, string $password) : ?Identite{
        $sql = <<<EOD
        select login,password,nom,prenom
        from users
        where login=:login and password=:password
EOD;
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':login',$login);
        $stmt->bindValue(':password',$password);
        $stmt->execute();
        $tab = $stmt->fetch();
        if(! isset($tab)){
            return null;
        }
        return new Identite($tab["login"],$tab["nom"],$tab["prenom"]);
    }
    
    function authentification(string $login, string $password) : ?Identite{ // version password hash
        $sql = <<<EOD
        select login,password,nom,prenom
        from users
        where login=:login 
EOD;
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':login',$login);
        $stmt->execute();
        $tab = $stmt->fetch();
        if(crypt($password,$tab["password"]) == $tab["password"]){
            return new Identite($tab["login"],$tab["nom"],$tab["prenom"]);
        }
        return null;
    }


    /**
    * @return bool indiquant si l'ajout a été réalisé
    */
    function createUser(string $login, string $password, string $nom, string $prenom) : bool	 {
        $sql = <<<EOD
        insert into "users" (login, password, nom, prenom)
        values (:login, :password, :nom, :prenom)
EOD;
        //try{
        //    $stmt = $this->connexion->prepare($sql);
        //    $stmt->bindValue(':login',$login);
        //    $stmt->bindValue(':password',$password);
        //    $stmt->bindValue(':nom',$nom);
        //    $stmt->bindValue(':prenom',$prenom);
        //    $stmt->execute();
        //    return true;
        //}
        //catch( PDOException $Exception){
        //    return false;
        //}

        try{
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindValue(':login',$login);
            $stmt->bindValue(':password',password_hash($password,CRYPT_BLOWFISH));
            $stmt->bindValue(':nom',$nom);
            $stmt->bindValue(':prenom',$prenom);
            $stmt->execute();
           return true;
        }
        catch( PDOException $Exception){
            return false;
        }
    }
	
}
?>
