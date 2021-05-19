<?php
// include(ROOT_FOLDER.'/Models/.php');

/**
 * ProduitDao : mise en place CRUD pour users
 */
class ProduitDao
{
	static $pdo=null;

	function __construct(){
        ProduitDao::$pdo = DatabasePDO::getInstance();
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

	function update($id,$libelle,$description,$stock,$prix,$categorie){
        $sql = 'UPDATE produits SET libelle=?, description=?, stock=?, prix=?, categorie_id=? WHERE id = ?';
        $stm = self::$pdo->prepare($sql);
        
        $args = array(
            $libelle,
            $description,
            $stock,
            $prix,
            $categorie,
            $id
        );
        $stm->execute($args);
        
        if($stm->rowCount()>0){
            return self::$pdo->lastInsertId();
        }
	}

	function delete($id){
        $sql = 'DELETE FROM produits WHERE id = ?';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$id]);
        if($stm->rowCount()>0){
            return 'Enregistrement supprimé!';
        }
	}

    function updateStock($id, $stock){
        $sql = 'UPDATE produits SET `stock` = stock - ? WHERE id = ?';
        $stm = self::$pdo->prepare($sql);
        $args = array(
            $stock,
            $id
        );
        $stm->execute($args);
    }

}