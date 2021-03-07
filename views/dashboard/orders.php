<?php
 include(ROOT_FOLDER.'views/shared/header.php');
?>

<div style="margin-top:50px" class="mx-5">

<h2>Liste des commandes</h2>
<div class="accordion" id="accordionExample">
<!-- ORDER -->
<?php foreach($orders as $order) { ?>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#order<?= $order->id ?>" aria-expanded="false" aria-controls="collapseTwo">
          Commande numéro : <?= $order->number ?> (cliquez pour afficher les détails)
          <br>
        </button>
      </h2>
    </div>
    <div id="order<?= $order->id ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
      <table class="table table-sm">
        <tbody>
            <tr>
                <th scope="row">Nom Prénom</th>
                <td><?= $order->nom ?> <?= $order->prenom ?></td>
            </tr>
            <tr>
                <th scope="row">Adresse</th>
                <td><?= $order->adresse ?></td>
            </tr>
            <tr>
                <th scope="row">Mail</th>
                <td><?= $order->mail ?></td>
            </tr>
            <tr>
                <th scope="row">Carte</th>
                <td><?php echo "xxxxxxxxxxxx".substr($order->card, -4); ?></td>
            </tr>
        </tbody>
        </table>
        <!-- ORDER DETAILS -->
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
            foreach($order->products as $produit){ 
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

        <!-- ORDER DETAILS -->
      </div>
    </div>
  </div>
<?php } ?>
<!-- ORDER -->
</div>


</div>
<?php include(ROOT_FOLDER.'/views/shared/footer.php'); ?>