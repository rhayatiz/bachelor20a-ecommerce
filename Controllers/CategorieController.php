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
    public function update(){
        if (isset($_POST['categorieModifier']))
        {
            $id = $_POST['id'];           
            $libelle = $_POST['libelle'];
            (new CategorieDao())->update($id, $libelle);
            header('Location: index.php?page=categories');
        }   

        else
        {
            $id = $_GET['id'];
            $categorie = (new CategorieDao())->get($id);
            $page_title = "Modifier Categorie";
            $this->render('dashboard.categorie.modifier', compact('page_title','categorie'));
            
        }
    }

}