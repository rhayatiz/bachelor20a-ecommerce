<?php
define('ROOT_FOLDER', "C:\\xampp\\htdocs\\bachelor20a-ecommerce\\");
if(!isset($_SESSION)){session_start();}
function dd($a){
    echo "<pre>";
    print_r($a);
    echo "</pre>";
    die();
}
dd($_SESSION['panier']);
/**
 * ROUTER 
 */
//REQUIRES
require('./Controllers/HomeController.php');
require('./Controllers/ProduitController.php');
require('./Controllers/CategorieController.php');
require('./Controllers/PanierController.php');


if (isset($_GET['page'])){
    $page = $_GET['page'];
} else {
    $page = 'home';
}

//Si l'utilisateur n'est pas connecté, renvoyer vers la page de connexion
// if(!isset($_SESSION['user'])){
//     $controller = new HomeController();
//     $controller->login();
// }else{
    //Si l'utilisateur est connecté, appeler le controller qui va charger les données et la vue
    if($page == 'home'){
        (new HomeController())->index();
    }else if($page == "logout"){
        (new HomeController())->logout();
    /****************************************PRODUITS*****************/
    }else if($page == "produits"){
        (new ProduitController())->index();
    }else if($page == "produitAjouter"){
        (new ProduitController())->add();
    }else if($page == "produitModifier"){
        (new ProduitController())->update();
    }else if($page == "produitSupprimer"){
        (new ProduitController())->delete();
    /****************************************CATEGORIES*****************/
    }else if($page == "categorie"){
        (new ProduitController())->showByCategorie($_GET['id']);
    }else if($page == "categories"){
        (new CategorieController())->index();
    }else if($page == "categorieAjouter"){
        (new CategorieController())->add();
    }else if($page == "categorieModifier"){
        (new CategorieController())->update();
    }else if($page == "categorieSupprimer"){
        (new CategorieController())->delete();
    /*************************************PANIER **********************/
    }else if($page == "panier"){
        if(isset($_GET['action'])){
            $action = $_GET['action'];
            //--------------------- actions----------
            if ($action == 'add'){
                (new PanierController())->add($_GET['id']);
            }else if($action == 'delete'){
                (new PanierController())->delete($_GET['id']);
            }else if($action == 'editQuantity'){
                (new PanierController())->editQuantity($_GET['id'], $_GET['quantity']);
            }
        }else{
            (new PanierController())->index();
        }
    /*************************************PAIEMENT **********************/
    }else if($page == "paiement"){
        if (isset($_POST['paiementConfirm'])){            
            (new PanierController())->payementConfirm();
        }else{
            (new PanierController())->payement();
        }
    }else if($page == "orders"){
        (new PanierController)->orders();
    }else if($page == "clearSession"){
        session_unset();
        header('Location: index.php');

    }else if($page == "dashboard"){
        (new HomeController())->login();
    }else{
        $controller = new HomeController();
        $controller->error('Page Not Found');
    // }
}



