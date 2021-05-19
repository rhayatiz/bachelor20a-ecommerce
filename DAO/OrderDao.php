<?php
require_once(ROOT_FOLDER.'/DAO/ProduitDao.php');

/**
 * OrderDao : mise en place CRUD pour users
 */
class OrderDao
{
	static $pdo=null;

	function __construct(){
        OrderDao::$pdo = DatabasePDO::getInstance();
	}

	function list(){//1 - Lire Données
        $sql='SELECT * FROM orders';
        $stm = self::$pdo->query($sql);
        $orders = $stm->fetchAll(PDO::FETCH_CLASS); //FETCH_BOTH - FETCH_CLASS - FETCH_ASSOC
        return $orders;
	}

	function get($id){
        $sql = 'SELECT * FROM orders WHERE id = ?';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$id]);
        return $stm->fetch(PDO::FETCH_ASSOC); 
    }

	function create($order){
        $sql = 'INSERT INTO orders (number, nom, prenom, adresse, mail, card, total) VALUES(?, ?, ?, ?, ?, ?, ?)';
        $stm = self::$pdo->prepare($sql);
        
        $args = array(
            $order['number'],
            $order['nom'],
            $order['prenom'],
            $order['adresse'],
            $order['mail'],
            $order['card'],
            $order['total'],
        );
        $stm->execute($args);
        
        if($stm->rowCount()>0){
            $lastid =  self::$pdo->lastInsertId();
        }
		//CREATION DES RELATIONS order_produit
		foreach($_SESSION['panier'] as $produit){
			$sql = 'INSERT INTO orders_produits (order_id, produit_id, quantite) VALUES(?, ?, ?)';
			$stm = self::$pdo->prepare($sql);
			$args = array(
				$lastid,
				$produit['id'],
				$produit['quantite']
			);
			$stm->execute($args);
		}


		return $lastid;
	}

	public function getOrderProducts($id){
		$produitDao = new ProduitDao();
		$panier = array();

		$sql = 'SELECT * FROM orders_produits WHERE order_id = ?';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$id]);
        $products = $stm->fetchAll(PDO::FETCH_CLASS); //FETCH_BOTH - FETCH_CLASS - FETCH_ASSOC

		foreach($products as $produit){
			$prod = $produitDao->get($produit->produit_id);
			$prod['quantite'] = $produit->quantite;
			$panier[] = $prod;
		}
        return $panier;
	}


}