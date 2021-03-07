<?php
require_once('Controller.php');
require_once(ROOT_FOLDER.'/DAO/ProduitDao.php');
require_once(ROOT_FOLDER.'/DAO/CategorieDao.php');

class ProduitController extends Controller{

    public function index(){
        $produits = (new ProduitDAO())->list();
        $message = 'hello, this message is from the homeController';
        $page_title = "Gestion des produits";
        $this->render('dashboard.produit.list', compact('message', 'page_title','produits'));
    }

    public function showByCategorie($id){
        $produits = (new ProduitDAO())->listByCategorie($id);
        $categories = (new CategorieDao())->list();
        $message = 'hello, this message is from the homeController';
        $page_title = "Gestion des produits";
        $this->render('home', compact('message', 'page_title','produits', 'categories'));
    }

    public function add(){
        //ENVOI FORMULAIRE, CREER LE PRODUIT
        if (isset($_POST['produitAjouter'])){
            $libelle = $_POST['libelle'];
            $stock = $_POST['stock'];
            $description = $_POST['description'];
            $prix = $_POST['prix'];
            $categorie = $_POST['categorie'];

            $acceptedFormats = array(
                'png',
                'gif',
                'jpeg',
                'jpg'
            );

            $upload_dir = ROOT_FOLDER."./img/";
            $file_name = basename($_FILES["image"]["name"]);
            $file = $upload_dir.$file_name;
            // test Format
            if(!in_array(strtolower(pathinfo($file,PATHINFO_EXTENSION)), $acceptedFormats)){
                header('Location: index.php?page=produitAjouter&msg=3');
                die;
            }

            if(is_uploaded_file($_FILES['image']['tmp_name'])){
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $file)){
                    $imgName = time().$file_name;
                    rename($upload_dir.$file_name, $upload_dir.$imgName);
                    (new ProduitDao())->create($libelle, $description,$stock, $imgName, $prix, $categorie);
                    header('Location: index.php?page=produits');
                }else{
                    //Probleme durant le sockage
                    header('Location: index.php?page=produitAjouter&msg=2');
                }
            }else{
                //Probleme durant le téléchargement PHP
                header('Location: index.php?page=produitAjouter&msg=2');
            }
            
        //PREMIERE VISITE, AFFICHER FORMULAIRE
        }else{
            $categories = (new CategorieDao())->list();
            $page_title = "Ajout produit";
            $this->render('dashboard.produit.ajouter', compact('page_title','categories'));
        }
    }

    public function delete(){
        $id = $_GET['id'];
        (new ProduitDao())->delete($id);
        header('Location: index.php?page=produits');
    }


}