<?php
include(ROOT_FOLDER.'/Models/User.php');

/**
 * UserDao : mise en place CRUD pour users
 */
class UserDao
{
	static $pdo=null;

	const DATABASE_HOST = 'localhost';
	const DATABASE_USER = 'root';
	const DATABASE_PASS = '';
	const DATABASE_NAME = 'bachelor20a-ecommerce';

	function __construct(){
		if(UserDao::$pdo==null){
			$this->createPDO();
		}
	}

	private function createPDO(){
		try{  
			UserDao::$pdo = new PDO('mysql:host=' . UserDao::DATABASE_HOST . ';dbname=' . UserDao::DATABASE_NAME . ';charset=utf8', UserDao::DATABASE_USER, UserDao::DATABASE_PASS);

			UserDao::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		  	//echo 'PDO créé : Connection OK!';
		}
		catch(PDOException $e){
		   die('Erreur : ' . $e->getMessage());
		}
	}

	function list(){//1 - Lire Données
        $sql='SELECT * FROM users';
        $stm = self::$pdo->query($sql);
        $users = $stm->fetchAll(PDO::FETCH_CLASS); //FETCH_BOTH - FETCH_CLASS - FETCH_ASSOC
        return $users;
	}

	function get($id){
        $sql = 'SELECT * FROM users WHERE id = ?';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$id]);
        return $stm->fetch(PDO::FETCH_ASSOC); 
    }

    function auth($login,$password){
        $sql = 'SELECT * FROM users WHERE login = ? and password = ?';
        $stm = self::$pdo->prepare($sql);
        $args = array(
            $login,
            md5($password)
        );
        $stm->execute($args);

        if($stm->rowCount()>0){
            $user = $stm->fetch(PDO::FETCH_ASSOC); 
            return $user;
        }else{
            return false;
        }
    }

	function create($user){
        $sql = 'INSERT INTO users (nom, prenom, date_naissance, email, password, role_id) VALUES(?,?,?,?,?,?)';
        $stm = self::$pdo->prepare($sql);
        
        $args = array(
            $user->getNom(),
            $user->getPrenom(),
            $user->getEmail(),
            $user->getDateNaissance(),
            md5($user->getPassword()),
            $user->getRole());
        $stm->execute($args);
        
        if($stm->rowCount()>0){
            return self::$pdo->lastInsertId();
        }
	}

	function update($user){
        $sql = 'UPDATE users SET (nom, prenom, date_naissance, email, password) VALUES(?,?,?,?,?) WHERE id = ?';
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

	function delete($id){
        $sql = 'DELETE FROM users WHERE id = ?';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$id]);
        if($stm->rowCount()>0){
            return 'Enregistrement supprimé!';
        }
	}

}