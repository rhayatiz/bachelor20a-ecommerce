<?php
require_once('Controller.php');
require_once(ROOT_FOLDER.'/DAO/ProduitDao.php');
require_once(ROOT_FOLDER.'/DAO/CategorieDao.php');
require_once(ROOT_FOLDER.'/DAO/OrderDao.php');

class PanierController extends Controller{

    public function index(){
        $categories = (new CategorieDao())->list();
        $page_title = "Gestion des produits";
        $panier = $_SESSION['panier'];
        
        if(count($_SESSION['panier']) > 0){
            $this->render('panier', compact('page_title','categories', 'panier'));
        }else{
            header('Location: index.php');
        }
    }

    public function delete($id){
        unset($_SESSION['panier'][$id]);
        $this->index();
    }

    public function add($id){
        $produit = (new ProduitDao())->get($id);
        if(isset($_SESSION['panier'])){
            if(isset($_SESSION['panier'][$id])){
                $_SESSION['panier'][$id]['quantite']++;
                header('Location: index.php');
            }else{
                $produit['quantite'] = 1;
                $_SESSION['panier'][$id] = $produit;
                header('Location: index.php');
            }
        }else{
            $_SESSION['panier'] = array();
            $produit['quantite'] = 1;
            $_SESSION['panier'][$id] = $produit;
                header('Location: index.php');
        }
    }
    
    public function editQuantity($id, $qte){
        $_SESSION['panier'][$id]['quantite'] = $qte;
        $this->index();
    }

    public function payement(){
        $categories = (new CategorieDao())->list();
        $page_title = "Paiement";
        $panier = $_SESSION['panier'];
        
        $this->render('paiement', compact('page_title','categories', 'panier'));
    }

    public function payementConfirm(){
        $produitDao = new ProduitDao();
        $categories = (new CategorieDao())->list();
        $page_title = "Paiement effectué";
        $panier = $_SESSION['panier'];
        $total = 0;
        $relation = array();
        foreach($panier as $produit){
            $total += $produit['quantite'] * $produit['prix'];
            $produitDao->updateStock($produit['id'], $produit['stock']);
        }
        //REDUIRE LE STOCK DU PRODUIT
        //CREATE ORDER
        $order['nom'] = $_POST['nom'];
        $order['prenom'] = $_POST['prenom'];
        $order['adresse'] = $_POST['adresse'];
        $order['mail'] = $_POST['mail'];
        $order['card'] = $_POST['carteBancaire'];
        $order['total'] = $total;
        $order['number'] = time();
        $orderDao = new OrderDao();
        $orderId = $orderDao->create($order);
        $order = $orderDao->get($orderId);

        unset($_SESSION['panier']);
        $this->render('paiement', compact('page_title','categories', 'panier', 'order'));
    }

    public function orders(){
        $orderDao = new OrderDao();
        $categories = (new CategorieDao())->list();
        $page_title = "Commandes";
        $orders = $orderDao->list();


        foreach($orders as $order){
            $order->products = $orderDao->getOrderProducts($order->id);
        }

        $this->render('dashboard.orders', compact('page_title','categories', 'orders'));

    }
}