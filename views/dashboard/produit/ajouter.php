<?php
 include(ROOT_FOLDER.'views/shared/header.php');
?>
<div class="mx-3">
    <div class="row my-3">
    <div class="col"><h2>Ajouter un produit</h2></div>
    </div>

    <?php
        if (isset($_GET['msg'])){
            $msg = $_GET['msg'];
            if ($msg == 1){
                echo "<div class='alert alert-success'>Image téléchargée!</div>";
            }else if($msg == 2){
                echo "<div class='alert alert-danger'>Erreur pendant le téléchargement</div>";
            }else if($msg == 3){
                echo "<div class='alert alert-danger'>Format image acceptés : jpeg/jpg/gif/png</div>";
            }
        }
    ?>
    <form method="POST" action="index.php?page=produitAjouter" enctype="multipart/form-data">

        <div class="form-group row">
            <label for="libelle" class="col-sm-2 col-form-label">Libelle</label>
            <div class="col-sm-10">
            <input name="libelle" type="text"  class="form-control" id="libelle" value="Libelle">
            </div>
        </div>

        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
            <input name="description" type="text" class="form-control" id="description" placeholder="Description">
            </div>
        </div>

        
        <div class="form-group row">
            <label for="image" class="col-sm-2 col-form-label">Image</label>
            <div class="col-sm-10">
            <input name="image" type="file" class="form-control" id="image">
            </div>
        </div>

        <div class="form-group row">
            <label for="stock" class="col-sm-2 col-form-label">Stock</label>
            <div class="col-sm-10">
            <input name="stock" type="number" step="1" class="form-control" id="stock">
            </div>
        </div>

        
        <div class="form-group row">
            <label for="prix" class="col-sm-2 col-form-label">Prix</label>
            <div class="col-sm-10">
            <input name="prix" type="number" step="0.01" class="form-control" id="prix">
            </div>
        </div>

        <div class="form-group row">
            <label for="categorie" class="col-sm-2 col-form-label">Catégorie</label>
            <div class="col-sm-10">
            <select name="categorie" class="form-select" aria-label="Default select example">
                <?php foreach($categories as $categorie){ ?>
                    <option value="<?= $categorie->id ?>"><?= $categorie->libelle ?></option>
                <?php } ?>
            </select>
            </div>
        </div>

        <input type="hidden" name="produitAjouter" value="1">

        <div>
        <a class="btn btn-secondary" href="index.php?page=produits">Annuler</a>
        <input type="submit" class="btn btn-success" value="Ajouter">
        </div>

    </form>

</div>
<?php include(ROOT_FOLDER.'views/shared/footer.php'); ?>