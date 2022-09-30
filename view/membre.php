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
                foreach ($requete as $topic) { ?> <!-- Affiche les données de la requete grâce à un foreach -->
                    <tr>
                        <td><?= $topic["titre"] ?></td>
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