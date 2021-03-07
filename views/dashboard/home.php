<?php
 include(ROOT_FOLDER.'views/shared/header.php');
?>

<div style="margin-top:100px" class="container mx-auto">
    <div class="row mx-auto" data-masonry='{"percentPosition": true }'>

        <?php foreach($produits as $produit){ ?>
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="./img/<?= $produit->img ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $produit->libelle ?></h5>
                        <p class="card-text"><?= $produit->description ?></p>
                        <a href="index.php?page=produitModifier&id=<?= $produit->id ?>" class="btn btn-warning">Modifier</a>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>
<?php include(ROOT_FOLDER.'/views/shared/footer.php'); ?>