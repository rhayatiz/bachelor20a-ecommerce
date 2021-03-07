<?php
// include(ROOT_FOLDER.'/Models/.php');

/**
 * ProduitDao : mise en place CRUD pour users
 */
class ProduitDao
{
	static $pdo=null;

	const DATABASE_HOST = 'localhost';
	const DATABASE_USER = 'root';
	const DATABASE_PASS = '';
	const DATABASE_NAME = 'bachelor20a-ecommerce';

	function __construct(){
		if(ProduitDao::$pdo==null){
			$this->createPDO();
		}
	}

	private function createPDO(){
		try{  
			ProduitDao::$pdo = new PDO('mysql:host=' . ProduitDao::DATABASE_HOST . ';dbname=' . ProduitDao::DATABASE_NAME . ';charset=utf8', ProduitDao::DATABASE_USER, ProduitDao::DATABASE_PASS);

			ProduitDao::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		  	//echo 'PDO créé : Connection OK!';
		}
		catch(PDOException $e){
		   die('Erreur : ' . $e->getMessage());
		}
	}

	function list(){//1 - Lire Données
        $sql='SELECT * FROM produits';
        $stm = self::$pdo->query($sql);
        $produits = $stm->fetchAll(PDO::FETCH_CLASS); //FETCH_BOTH - FETCH_CLASS - FETCH_ASSOC
        return $produits;
	}

    
    function listByCategorie($id){
        $sql='SELECT * FROM produits WHERE categorie_id = ?';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$id]);
        $produits = $stm->fetchAll(PDO::FETCH_CLASS); //FETCH_BOTH - FETCH_CLASS - FETCH_ASSOC
        return $produits;
    }

	function get($id){
        $sql = 'SELECT * FROM produits WHERE id = ?';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$id]);
        return $stm->fetch(PDO::FETCH_ASSOC); 
    }

	function create($libelle,$description,$stock,$img, $prix, $categorie){
        $sql = 'INSERT INTO produits (libelle, description, stock, img, prix, categorie_id) VALUES(?, ?, ?, ?, ?, ?)';
        $stm = self::$pdo->prepare($sql);
        
        $args = array(
            $libelle,
            $description,
            $stock,
            $img,
            $prix,
            $categorie
        );
        $stm->execute($args);
        
        if($stm->rowCount()>0){
            return self::$pdo->lastInsertId();
        }
	}
/*
	function update($user){
        $sql = 'UPDATE produits SET (nom, prenom, date_naissance, email, password) VALUES(?,?,?,?,?) WHERE id = ?';
        $stm = self::$pdo->prepare($sql);
        
        $args = array(
            $user->getNom(),
            $user->getPrenom(),
            $user->getEmail(),
            $user->getDateNaissance(),
             md5($user->getPassword()),
            $user->id
        );
        $stm->execute($args);
        
        if($stm->rowCount()>0){
            return self::$pdo->lastInsertId();
        }
	}
    */

	function delete($id){
        $sql = 'DELETE FROM produits WHERE id = ?';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$id]);
        if($stm->rowCount()>0){
            return 'Enregistrement supprimé!';
        }
	}


}