<?php
 include(ROOT_FOLDER.'views/shared/header.php');
?>

<nav class="navbar navbar-expand-md navbar-dark bg-white shadow fixed-top">
    <div class="container">
        <a class="navbar-brand abs text-dark mr-5" href="index.php">B2O</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="nav">
            <li class="nav-item dropdown">
                <a class="nav-link text-dark dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Catégories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <?php foreach($categories as $categorie){ ?>
                    <a class="dropdown-item" href="index.php?page=categorie&id=<?= $categorie->id ?>"><?= $categorie->libelle ?></a>
                <?php } ?>
                </div>
            </li>
        </ul>
    </div>
</nav>

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