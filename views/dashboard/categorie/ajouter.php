<?php
 include(ROOT_FOLDER.'views/shared/header.php');
?>
<div class="mx-3">
    <div class="row my-3">
    <div class="col"><h2>Ajouter un produit</h2></div>
    </div>

    <form method="POST" action="index.php?page=categorieAjouter">

        <div class="form-group row">
            <label for="libelle" class="col-sm-2 col-form-label">Libelle</label>
            <div class="col-sm-10">
            <input name="libelle" type="text"  class="form-control" id="libelle" value="Libelle">
            </div>
        </div>


        <input type="hidden" name="categorieAjouter" value="1">

        <div>
        <a class="btn btn-secondary" href="index.php?page=categories">Annuler</a>
        <input type="submit" class="btn btn-success" value="Ajouter">
        </div>

    </form>

</div>
<?php include(ROOT_FOLDER.'views/shared/footer.php'); ?>