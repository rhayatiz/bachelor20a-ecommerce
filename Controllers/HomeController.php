<?php
require(ROOT_FOLDER.'Controllers/Controller.php');
require(ROOT_FOLDER.'DAO/UserDao.php');
require(ROOT_FOLDER.'DAO/ProduitDao.php');
require(ROOT_FOLDER.'DAO/CategorieDao.php');

class HomeController extends Controller{

    public function index(){
        $categories = (new CategorieDao())->list();
        $produits = (new ProduitDao())->list();
        $message = 'hello, this message is from the homeController';
        $page_title = "Accueil";

        if(isset($_SESSION['user'])){
            if($_SESSION['user']['isAdmin'] == 1){
                $this->render('dashboard.home', compact('message', 'page_title', 'produits', 'categories'));
                die();
            }
        }
        $this->render('home', compact('message', 'page_title', 'produits', 'categories'));
    }

    public function error($error){
        $this->render('error', compact('error'));
    }

    public function login(){
        // Tentative de connexion
        if(isset($_POST['loginForm'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            if ($user = (new UserDao())->auth($email, $password)){
                $_SESSION['user'] = $user;
                header('Location: index.php');
                die();
            }else{
                $error = "Identifiants incorrects!";
                $this->render('login', compact('error'));
            }
        // Première visite de la page, afficher le formulaire de connexion
        }else{
            $this->render('login');
        }
    }

    public function logout(){
        unset($_SESSION['user']);
        header('Location: index.php');
    }

}