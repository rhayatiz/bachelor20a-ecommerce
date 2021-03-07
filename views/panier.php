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

            <li class="nav-item">
            <a href="index.php?page=clearSession">clearSession</a>
            </li>
        </ul>
    </div>
</nav>

<div style="margin-top:100px" class="container mx-auto">
    <h1>Mon panier</h1>
    <table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Libelle</th>
      <th scope="col" class="text-right">Quantité</th>
      <th scope="col" class="text-right">P.U</th>
      <th scope="col" class="text-right">Prix</th>
      <th scope="col" class="text-center"></th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $total = 0;
    foreach($panier as $produit){ 
    $total += $produit['prix'] * $produit['quantite'];
        ?>
        <tr>
            <td><img class='img-fluid rounded' style='max-height:100px' src="./img/<?= $produit['img'] ?>"/></td>
            <td><?= $produit['libelle'] ?></td>
            <!-- Quantité -->
            <td class="text-right">
                <select onchange="changeQte(<?= $produit['id'] ?>, this)" class="form-select" aria-label="Quantité">
                    <?php for ($i=1; $i < $produit['stock']; $i++) { 
                        $selected = $i == $produit['quantite'] ?  'selected' : '';
                        echo "<option $selected value='$i'>$i</option>";
                    }?>
                </select>
            </td>
            <!-- Quantité -->
            <td class="text-right"><?= $produit['prix'] ?> €</td>
            <td class="text-right"><?= $produit['prix'] * $produit['quantite'] ?> €</td>
            <td class="text-center"><a href="index.php?page=panier&action=delete&id=<?= $produit['id'] ?>"><i style="font-size:20px;" class="far fa-trash-alt"></i></a></td>
        </tr>
    <?php } ?>
    <tfoot>
        <th colspan="5">TOTAL</th>
        <td class="text-right"><?= $total ?> €</td>
    </tfoot>
  </tbody>
</table>

<hr>

<div class="row my-5">
      <div class="col">
          <a class="float-right btn btn-sm btn-success">Paiement</a>
      </div>
</div>

</div>


</div>

<script>
function changeQte($produit, $e){
    $qte = $e.value;
    location = 'index.php?page=panier&action=editQuantity&id='+$produit+'&quantity='+$qte; 
}
</script>

<?php include('shared/footer.php'); ?>