<?php

use Controller\CategorieController;
use Controller\MembreController;
use Controller\PostController;
use Controller\TopicController;

spl_autoload_register(function ($class_name) {
    include $class_name.'.php';
});

$ctrlCategorie = new CategorieController();
$ctrlMembre = new MembreController();
$ctrlPost = new PostController();
$ctrlTopic = new TopicController();

if(isset($_GET["action"])){
    switch ($_GET["action"]) {
        case "listCategorie": $ctrlCategorie->categorieDisplay(); break;
        case "listTopic": $ctrlTopic->topicDisplay($_GET["id"]); break;
        case "listMessage": $ctrlPost->messageDisplay($_GET["id"]); break;
        case "addPost": $ctrlPost->addPost(); break;
        case "addTopic": $ctrlTopic->addTopic(); break;
        case "membreDisplay": $ctrlMembre->membreDisplay($_GET["id"]); break;
    }
}