<?php
 include('shared/head.php');
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
            <li class="nav-item">
            <?php if(isset($_SESSION['panier'])){ 
                $qte = 0;
                foreach($_SESSION['panier'] as $produit){
                    $qte += $produit['quantite'];
                }
                ?>
                <a href="index.php?page=panier" class="nav-link text-dark">
                    <i class="fas fa-shopping-cart"></i>
                    Panier (<?= $qte ?>)
            <?php }else{ ?>
                <a class="nav-link text-muted">
                    <i class="fas fa-shopping-cart"></i>
                    Panier (0)
            <?php }?>
                </a>
            </li>

            <!-- <li class="nav-item">
            <a href="index.php?page=clearSession">clearSession</a>
            </li> -->
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
                        <?php if($produit->stock > 0){?>
                            <a href="index.php?page=panier&action=add&id=<?= $produit->id ?>" class="btn btn-primary">Ajouter au panier</a>
                        <?php }else{ ?>
                            <a class="btn btn-secondary disabled">Rupture de stock</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>


</div>

<?php include('shared/footer.php'); ?>