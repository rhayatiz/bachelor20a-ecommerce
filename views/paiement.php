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
    <h1>Ma commande</h1>
    <table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Libelle</th>
      <th scope="col" class="text-right">Quantité</th>
      <th scope="col" class="text-right">P.U</th>
      <th scope="col" class="text-right">Prix</th>
      <th scope="col" class="text-right">Total</th>
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
            <td><?= $produit['quantite'] ?></td>
            </td>
            <!-- Quantité -->
            <td class="text-right"><?= $produit['prix'] ?> €</td>
            <td class="text-right"><?= $produit['prix'] * $produit['quantite'] ?> €</td>
        </tr>
    <?php } ?>
    <tfoot>
        <th colspan="5">TOTAL</th>
        <td class="text-right"><?= $total ?> €</td>
    </tfoot>
  </tbody>
</table>

<hr>

<?php if(!isset($order)){ ?>
<!------------------- PAIEMENT --------------------->
<div class="my-5">
<h1>Mes informations</h1>

<form method="POST" action="index.php?page=paiement">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nom">Nom</label>
      <input name="nom" type="text" class="form-control" id="nom" placeholder="Nom" required>
    </div>
    <div class="form-group col-md-6">
      <label for="prenom">Prénom</label>
      <input name="prenom" type="text" class="form-control" id="prenom" placeholder="Prénom" required>
    </div>
  </div>
  <div class="form-group">
    <label for="mail">Mail</label>
    <input name="mail" type="text" class="form-control" id="mail" placeholder="mail" required >
  </div>
  <div class="form-group">
    <label for="adresse">Adresse de livraison complète</label>
    <input name="adresse" type="text" class="form-control" id="adresse" placeholder="Adresse de livraison complète" required >
  </div>
  <div class="form-group">
    <label for="carteBancaire">Carte bancaire</label>
    <input class="form-control" name="carteBancaire" id="carteBancaire" type="text" placeholder="1234 5678 9101 1123" maxlength="19" required>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="expirationDate">Date d'expiration</label>
      <input type="text" class="form-control" id="expirationDate" placeholder="01/23" maxlength="5" required>
    </div>
    <div class="form-group col-md-6">
      <label for="cvv">CVV</label>
      <input type="text" class="form-control" id="cvv" placeholder="123" maxlength="3" required>
    </div>
  </div>
  <hr>
  <input type="hidden" name="paiementConfirm">
  <div class="row my-5">
      <div class="col">
          <input type="submit" class="float-right btn btn-sm btn-success" value="Confirmer">
      </div>
  </div>
</form>
</div>
<!------------------- PAIEMENT --------------------->
<!------------------- Reçu --------------------->
<?php }else{ ?>

<h3>Votre commande a bien été prise en compte!</h3>
<form>
  <div class="form-group row">
    <label for="staticCommande" class="col-sm-2 col-form-label">Commande numero</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" id="staticCommande" value="<?= $order['number'] ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="staticName" class="col-sm-2 col-form-label">Nom Complet</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" id="staticName" value="<?= $order['nom'] ?> <?= $order['prenom'] ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="staticAdress" class="col-sm-2 col-form-label">Adresse</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" id="staticAdress" value="<?= $order['adresse'] ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="staticMail" class="col-sm-2 col-form-label">Mail</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" id="staticMail" value="<?= $order['mail'] ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="staticTotal" class="col-sm-2 col-form-label">TOTAL</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" id="staticTotal" value="<?= $order['total'] ?>">
    </div>
  </div>
</form>

<?php } ?>
<!------------------- Reçu --------------------->

<hr>



</div>


</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    $('#carteBancaire').on('keyup', function() {
    var foo = $(this).val().split(" ").join(""); 
    if (foo.length > 0) {
        foo = foo.match(new RegExp('.{1,4}', 'g')).join(" ");
    }
    $(this).val(foo);
    });
});
</script>

<?php include('shared/footer.php'); ?>