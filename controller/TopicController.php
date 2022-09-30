<?php

namespace Controller;
use Model\Connect;

class TopicController {

    public function topicDisplay($id){

        $pdo = Connect::seconnecter();

        $requete = $pdo->prepare("
        SELECT t.id_topic, titre, nom_categorie, pseudo, creer_le, verouille, t.id_categorie, t.id_membre
        FROM topic t
        INNER JOIN categorie c ON t.id_categorie = c.id_categorie
        INNER JOIN membre m ON t.id_membre = m.id_membre
        WHERE t.id_categorie = :id
        order by creer_le desc
        ");

        $requete->execute([
            "id" => $id
        ]);

        $requete_membre = $pdo->query(
            "SELECT * from membre"
        );
        $requete_membre->execute();

        $requete_cat = $pdo->query(
            "SELECT * from categorie"
        );
        $requete_cat->execute();

        require "view/topic.php";
    }

    public function addTopic()
    {
        $noerror = [
            $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            $membre = filter_input(INPUT_POST, 'membre', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            $categorie = filter_input(INPUT_POST, 'categorie', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            $statut = filter_input(INPUT_POST, 'statut', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            $creer_le = filter_input(INPUT_POST, 'creer_le', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        ];
        
        
        if (!empty($noerror)) {
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare(
                "INSERT INTO topic (titre, id_membre, id_categorie, verouille, creer_le)
                VALUES (:titre, :membre, :categorie, :statut, :creer_le)"
            );
            $requete->execute(
                [
                    'titre' => $titre,
                    'membre' => $membre,
                    'categorie' => $categorie,
                    'statut' => $statut,
                    'creer_le' => $creer_le,
                ]
            );

            header('location:'.$_SERVER['HTTP_REFERER']);
            die();
        } else {
            echo 'une erreur est survenue';
        }
    }
}