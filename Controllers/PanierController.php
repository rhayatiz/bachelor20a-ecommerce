<?php
require_once('Controller.php');
require_once(ROOT_FOLDER.'/DAO/ProduitDao.php');
require_once(ROOT_FOLDER.'/DAO/CategorieDao.php');

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

}