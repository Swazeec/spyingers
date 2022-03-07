<?php

$targetId = htmlspecialchars(intval($_GET['target']));

if(
    !empty($_POST['firstname']) &&
    !empty($_POST['lastname']) &&
    !empty($_POST['codename']) &&
    !empty($_POST['birthDate'])
){
    // VARIABLES - MODIFICATIONS
    $newFirstname = htmlspecialchars($_POST['firstname']);
    $newLastname = htmlspecialchars($_POST['lastname']);
    $newCodename = htmlspecialchars($_POST['codename']);
    $newBirthDate = htmlspecialchars($_POST['birthDate']);

    // INFOS DE LA CIBLE
    $targetInfosReq = $bdd->prepare('SELECT * FROM targets WHERE id = :id;');
    $targetInfosReq->bindValue(':id', $targetId);
    $targetInfosReq->execute();
    $targetInfos = $targetInfosReq->fetch(PDO::FETCH_ASSOC);

    // MAJ DE LA TABLE

    if($newFirstname != $targetInfos['firstname']){
        $updateFirstname = $bdd->prepare('UPDATE targets SET firstname = :fn WHERE id = :id ;');
        $updateFirstname->bindValue(':fn', $newFirstname);
        $updateFirstname->bindValue(':id', $targetId);
        $updateFirstname->execute();
    }

    if($newLastname != $targetInfos['lastname']){
        $updateLastname = $bdd->prepare('UPDATE targets SET lastname = :ln WHERE id = :id ;');
        $updateLastname->bindValue(':ln', $newLastname);
        $updateLastname->bindValue(':id', $targetId);
        $updateLastname->execute();
    }

    if($newCodename != $targetInfos['codename']){
        $updateCodename = $bdd->prepare('UPDATE targets SET codename = :cn WHERE id = :id ;');
        $updateCodename->bindValue(':cn', $newCodename);
        $updateCodename->bindValue(':id', $targetId);
        $updateCodename->execute();
    }

    if($newBirthDate != $targetInfos['birthdate']){
        $updateBirthDate = $bdd->prepare('UPDATE targets SET birthdate = :bDate WHERE id = :id ;');
        $updateBirthDate->bindValue(':bDate', $newBirthDate);
        $updateBirthDate->bindValue(':id', $targetId);
        $updateBirthDate->execute();
    }

    header('location:./targets.php?update=success');
}