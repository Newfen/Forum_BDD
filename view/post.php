<?php ob_start(); ?>
<?php $topic = $requete_topic->fetch() ?>
<?php  

    if ($requete->rowCount() == 0) {
    echo "Aucun message";
} else{

    ?>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>Message</th>
                <th>Créer le</th>
                <th>Pseudo</th>
                <th>Catégorie</th>
            </tr>
        </thead>

        <tbody>
            <!-- On récupère et on affiche les données de la requete grâce à un foreach -->
            <!-- On utilise un "fetchAll" car un simple fetch ne renvoie qu'une ligne -->
            <?php foreach ($requete->fetchAll() as $message) { ?>
                <tr>
                    <td><?= $message["message"] ?></td>
                    <td> <?= $message["creer_le"] ?></td>
                    <td><a href="index.php?action=membreDisplay&id=<?= $message["id_membre"] ?>"><?= $message["pseudo"] ?></a></td>
                    <td><?= $message["titre"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php  } ?>

        <?php if ($topic['verouille'] == 1) { ?>
            <form action="index.php?action=addPost" method="post">
                <label for="">membre</label>
                <select name="membre">
                    <?php foreach ($requete_membre->fetchAll() as $membre) { ?>
                        <option value="<?= $membre["id_membre"] ?>"><?= $membre["pseudo"] ?></option>
                    <?php } ?>
                </select>
                <label for="">Message</label>
                <input type="textarea" name="message">
                <input type="hidden" value="<?php echo date("Y-m-d"); ?>" name="creer_le">
                <input type="hidden" value="<?= $topic["id_topic"] ?>" name="id_topic">
                <input type="submit">
            </form>
        <?php } ?>
</div>

<?php
$titre = "ELAN TALK";
$contenu = ob_get_clean(); // Récupère tout le contenu dans une variabl
require "view/template.php"; ?>