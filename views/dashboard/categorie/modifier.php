<?php
 include(ROOT_FOLDER.'views/shared/header.php');
?>
<div class="mx-3">
    <div class="row my-3">
    <div class="col"><h2>Modifier une categorie</h2></div>
    </div>

    <form method="POST" action="index.php?page=categorieModifier">

        <div class="form-group row">
            <label for="id" class="col-sm-2 col-form-label">id</label>
            <div class="col-sm-10">
            <input name="id" type="text"  class="form-control" id="id" readonly value="<?= $categorie['id']?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="libelle" class="col-sm-2 col-form-label">Libelle</label>
            <div class="col-sm-10">
            <input name="libelle" type="text"  class="form-control" id="libelle" value="<?= $categorie['libelle']?>">
            </div>
        </div>


        <input type="hidden" name="categorieModifier" value="1">

        <div>
        <a class="btn btn-secondary" href="index.php?page=categories">Annuler</a>
        <input type="submit" class="btn btn-success" value="Modifier">
        </div>

    </form>

</div>
<?php include(ROOT_FOLDER.'views/shared/footer.php'); ?>