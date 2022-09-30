<?php ob_start(); ?>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>Sujet</th>
                <th>Catégorie</th>
                <th>Pseudo</th>
                <th>Créer le</th>
                <th>Verouille</th>
            </tr>
        </thead>

        <tbody>
            <!-- On récupère et on affiche les données de la requete grâce à un foreach -->
            <!-- On utilise un "fetchAll" car un simple fetch ne renvoie qu'une ligne -->
            <?php foreach ($requete->fetchAll() as $topic) { ?>
                <tr>
                    <td><a href="index.php?action=listMessage&id=<?= $topic["id_topic"] ?>"> <?= $topic["titre"] ?></a></td>
                    <td><?= $topic["nom_categorie"] ?></td>
                    <td><a href="index.php?action=membreDisplay&id=<?= $topic["id_membre"] ?>"><?= $topic["pseudo"] ?></a></td>
                    <td><?= $topic["creer_le"] ?></td>
                    <td><?= $topic["verouille"] == 1 ? "ouvert" : "fermer" ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <form action="index.php?action=addTopic" method="post">
        <label for="">Nom de la Catégorie</label>
        <input type="text" name="titre">
        <select name="membre">
            <?php foreach ($requete_membre->fetchAll() as $membre) { ?>
                <option value="<?= $membre["id_membre"] ?>"><?= $membre["pseudo"] ?></option>
            <?php } ?>
        </select>
        <input type="hidden" value="<?= $topic["id_categorie"] ?>" name="categorie">
        <input type="hidden" name="statut" value="<?= $topic['verouille'] = 1?>">
        <input type="hidden" value="<?php echo date("Y-m-d"); ?>" name="creer_le">
        <input type="submit">
    </form>
</div>


<?php
$titre = "ELAN TALK";
$contenu = ob_get_clean(); // Récupère tout le contenu dans une variable
require "view/template.php"; ?>