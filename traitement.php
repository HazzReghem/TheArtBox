<?php

if(
    empty($_POST['titre'])
    || empty($_POST['artiste'])
    || empty($_POST['image'])
    || empty($_POST['description'])
    || strlen($_POST['description']) < 3
    || !filter_var($_POST['image'], FILTER_VALIDATE_URL)
){
    header('Location: ajouter.php?erreur=true');
} else {
    $titre = htmlspecialchars($_POST['titre']);
    $artiste = htmlspecialchars($_POST['artiste']);
    $image = htmlspecialchars($_POST['image']);
    $description = htmlspecialchars($_POST['description']);


require 'bdd.php';  

$db = connexion();
$req = $db->prepare('INSERT INTO oeuvres (titre, artiste, description, image) VALUES (?, ?, ?, ?)');
$req->execute([$titre, $artiste, $description, $image]);

header('Location: oeuvre.php?id=' . $db->lastInsertId());

}
