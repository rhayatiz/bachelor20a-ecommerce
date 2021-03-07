<?php
require_once('Controller.php');
require_once(ROOT_FOLDER.'/DAO/CategorieDao.php');

class CategorieController extends Controller{

    public function index(){
        $categories = (new CategorieDao())->list();
        $message = 'hello, this message is from the homeController';
        $page_title = "Gestion des catégories";
        $this->render('dashboard.categorie.list', compact('message', 'page_title','categories'));
    }

    public function add(){
        if (isset($_POST['categorieAjouter'])){
            $libelle = $_POST['libelle'];
            (new CategorieDao())->create($libelle);
            header('Location: index.php?page=categories');
        }else{
            $page_title = "Ajout catégorie";
            $this->render('dashboard.categorie.ajouter', compact('page_title'));
        }
    }

    public function delete(){
        $id = $_GET['id'];
        (new CategorieDao())->delete($id);
        header('Location: index.php?page=categories');
    }

}