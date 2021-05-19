<?php
/**
 * CategorieDao : mise en place CRUD pour users
 */
class CategorieDao
{
	static $pdo=null;

	function __construct(){
        CategorieDao::$pdo = DatabasePDO::getInstance();
	}

	function list(){//1 - Lire Données
        $sql='SELECT * FROM categories';
        $stm = self::$pdo->query($sql);
        $categories = $stm->fetchAll(PDO::FETCH_CLASS); //FETCH_BOTH - FETCH_CLASS - FETCH_ASSOC
        return $categories;
	}

	function get($id){
        $sql = 'SELECT * FROM categories WHERE id = ?';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$id]);
        return $stm->fetch(PDO::FETCH_ASSOC); 
    }

	function create($libelle){
        $sql = 'INSERT INTO categories (libelle) VALUES(?)';
        $stm = self::$pdo->prepare($sql);
        
        $args = array(
            $libelle
        );
        $stm->execute($args);
        
        if($stm->rowCount()>0){
            return self::$pdo->lastInsertId();
        }
	}

    function update($id,$libelle){
        $sql = 'UPDATE categories SET libelle=? WHERE id = ?';
        $stm = self::$pdo->prepare($sql);
        
        $args = array(
            $libelle,
            $id
        );
        $stm->execute($args);
        
        if($stm->rowCount()>0){
            return self::$pdo->lastInsertId();
        }
	}

	function delete($id){
        $sql = 'DELETE FROM categories WHERE id = ?';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$id]);
        if($stm->rowCount()>0){
            return 'Enregistrement supprimé!';
        }
	}

}