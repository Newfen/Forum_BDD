<?php

namespace Controller;
use Model\Connect;

class CategorieController {

    public function categorieDisplay(){

        $pdo = Connect::seConnecter(); // On instancie un objet de la classe connect avec la fonction "seConnecter" qu'on a créer avec
        // On créer la requete dans une variable pour pouvoir l'uliliter ailleurs
        $requete = $pdo->query("
            SELECT id_categorie, nom_categorie FROM categorie
            order by nom_categorie 
        ");
    
        require "view/accueil.php"; // Permets de relier la fonction au fichier "listActeurs.php" dans lequel on va l'utiliser
    }
}