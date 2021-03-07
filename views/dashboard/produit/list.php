<?php
 include(ROOT_FOLDER.'views/shared/header.php');
?>
<div class="mx-3">
    <div class="row my-3">
    <div class="col"><h2>Liste des produits</h2></div>
    <div class="col"><a class="btn btn-success" href="index.php?page=produitAjouter">Ajouter un produit</a></div>
    </div>
        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col"></th>
            <th scope="col">Libelle</th>
            <th scope="col">Description</th>
            <th scope="col">Stock</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($produits as $produit){
                echo "<tr>";
                    echo "<td>".$produit->id."</td>";
                    echo "<td><img class='img-fluid rounded' style='max-height:100px' src='./img/".$produit->img."'/></td>";
                    echo "<td>".$produit->libelle."</td>";
                    echo "<td>".$produit->description."</td>";
                    echo "<td>".$produit->stock."</td>";
                    echo "<td>
                    <a href='index.php?page=produitModifier&id=".$produit->id."' class='btn btn-sm btn-warning'>Modifier</a>
                    <a href='index.php?page=produitSupprimer&id=".$produit->id."' class='btn btn-sm btn-danger'>Supprimer</a>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
        </table>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php include(ROOT_FOLDER.'views/shared/footer.php'); ?>