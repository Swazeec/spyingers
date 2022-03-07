<?php
if(
    !empty($_POST['firstname']) &&
    !empty($_POST['lastname']) &&
    !empty($_POST['codename']) &&
    !empty($_POST['birthDate']) &&
    !empty($_POST['nationality'])
){
    // VARIABLES
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $codename = htmlspecialchars($_POST['codename']);
    $birthDate = htmlspecialchars($_POST['birthDate']);
    $nationalityId = htmlspecialchars($_POST['nationality']);


    // REQUETE

    $targetsReq = $bdd->prepare('INSERT INTO targets (firstname, lastname, birthdate, codename, nationality_id, mission_id) VALUES (:fn, :ln, :bdate, :cn, :nid, null);');
    $targetsReq->bindValue(':fn', $firstname);
    $targetsReq->bindValue(':ln', $lastname);
    $targetsReq->bindValue(':bdate', $birthDate);
    $targetsReq->bindValue(':cn', $codename);
    $targetsReq->bindValue(':nid', $nationalityId);
    $targetsReq->execute();

    header('location:./targets.php?message=success');
} 