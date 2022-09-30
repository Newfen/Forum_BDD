<?php

namespace Controller;

use DateTime;
use Model\Connect;

class PostController {

    public function messageDisplay($id){

        $pdo = Connect::seconnecter();

        $requete = $pdo->prepare("
        SELECT p.id_topic, message, p.creer_le, pseudo, titre, verouille, p.id_membre
        FROM post p
        INNER JOIN membre m ON m.id_membre = p.id_membre
        INNER JOIN topic t ON p.id_topic = t.id_topic
        WHERE p.id_topic = :id
        order by p.creer_le desc
        ");
        $requete->execute([
            "id" => $id
        ]);

        $requete_membre = $pdo->query(
            "SELECT * from membre"
        );

        $requete_membre->execute();

        $requete_topic = $pdo->prepare(
            "SELECT * FROM topic WHERE id_topic = :id"
        );

        $requete_topic->execute([
            "id" => $id
        ]);

        require "view/post.php";
    }

    

    public function addPost()
    {

        $noerror = [
            $membre = filter_input(INPUT_POST, 'membre', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            $date = filter_input(INPUT_POST, 'creer_le', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            $topic = filter_input(INPUT_POST, 'id_topic', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        ];
        
        
        if (!empty($noerror)) {
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare(
                "INSERT INTO post (message, creer_le, id_membre, id_topic)
                VALUES (:message, :creer_le, :id_membre, :id_topic)"
            );
            $requete->execute(
                [
                    'message' => $message,
                    'creer_le' => $date,
                    'id_membre' => $membre,
                    'id_topic' => $topic,
                ]
            );
            header('location:'.$_SERVER['HTTP_REFERER']);
            die();
        } else {
            echo 'une erreur est survenue';
        }
    }
}