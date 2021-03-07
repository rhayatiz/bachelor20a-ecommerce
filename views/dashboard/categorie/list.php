<?php
 include(ROOT_FOLDER.'views/shared/header.php');
?>
<div class="mx-3">
    <div class="row my-3">
    <div class="col"><h2>Liste des catégories</h2></div>
    <div class="col"><a class="btn btn-success" href="index.php?page=categorieAjouter">Ajouter une catégorie</a></div>
    </div>
        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Libelle</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($categories as $categorie){
                echo "<tr>";
                    echo "<td>".$categorie->id."</td>";
                    echo "<td>".$categorie->libelle."</td>";
                    echo "<td>
                    <a href='index.php?page=categorieModifier&id=".$categorie->id."' class='btn btn-sm btn-warning'>Modifier</a>
                    <a href='index.php?page=categorieSupprimer&id=".$categorie->id."' class='btn btn-sm btn-danger'>Supprimer</a>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
        </table>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php include(ROOT_FOLDER.'views/shared/footer.php'); ?>