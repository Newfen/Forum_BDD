<!-- Récupère toutes les données pour pouvoir les afficher ailleurs  -->
<?php ob_start(); ?>  

<div class="container">
    <table class="acteur-table">
        <thead>
            <tr>
                <th>Nom</th>
            </tr>
        </thead>

        <tbody>
            <?php
                foreach ($requete as $categorie) { ?> <!-- Affiche les données de la requete grâce à un foreach -->
                    <tr>
                        <td><a href="index.php?action=listTopic&id=<?= $categorie["id_categorie"] ?>"><?= $categorie["nom_categorie"] ?></a></td>
                    </tr>
        <?php }
                $requete = null;
        ?>
        </tbody>
    </table>
</div>


<?php
$titre = "ELAN FORAMU";
$contenu = ob_get_clean(); // Récupère tout le contenu dans une variabl
require "view/template.php"; ?>

