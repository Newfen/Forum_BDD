<?php

namespace Controller;
use Model\Connect;

class MembreController {

    public function membreDisplay($id)
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare(
            "SELECT id_topic, m.id_membre, titre, pseudo
            FROM membre m
            INNER JOIN topic t ON m.id_membre = t.id_membre
            WHERE m.id_membre = :id
        ");

        $requete->execute([
            "id" => $id
        ]);

        require "view/membre.php";
    }
}