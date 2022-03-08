<?php
if(
    !empty($_POST['firstname']) &&
    !empty($_POST['lastname']) &&
    !empty($_POST['codename']) &&
    !empty($_POST['nationality'])
){
    // VARIABLES
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $codename = htmlspecialchars($_POST['codename']);
    $nationalityId = htmlspecialchars($_POST['nationality']);


    // REQUETE

    $targetsReq = $bdd->prepare('INSERT INTO contacts (firstname, lastname, codename, nationality_id) VALUES (:fn, :ln, :cn, :nid);');
    $targetsReq->bindValue(':fn', $firstname);
    $targetsReq->bindValue(':ln', $lastname);
    $targetsReq->bindValue(':cn', $codename);
    $targetsReq->bindValue(':nid', $nationalityId);
    $targetsReq->execute();

    header('location:./contacts.php?message=success');
} 