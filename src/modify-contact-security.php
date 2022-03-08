<?php

$contactId = htmlspecialchars(intval($_GET['contact']));

if(
    !empty($_POST['firstname']) &&
    !empty($_POST['lastname']) &&
    !empty($_POST['codename'])
){
    // VARIABLES - MODIFICATIONS
    $newFirstname = htmlspecialchars($_POST['firstname']);
    $newLastname = htmlspecialchars($_POST['lastname']);
    $newCodename = htmlspecialchars($_POST['codename']);

    // INFOS DU CONTACT
    $contactInfosReq = $bdd->prepare('SELECT * FROM contacts WHERE id = :id;');
    $contactInfosReq->bindValue(':id', $contactId);
    $contactInfosReq->execute();
    $contactInfos = $contactInfosReq->fetch(PDO::FETCH_ASSOC);

    // MAJ DE LA TABLE

    if($newFirstname != $contactInfos['firstname']){
        $updateFirstname = $bdd->prepare('UPDATE contacts SET firstname = :fn WHERE id = :id ;');
        $updateFirstname->bindValue(':fn', $newFirstname);
        $updateFirstname->bindValue(':id', $contactId);
        $updateFirstname->execute();
    }

    if($newLastname != $contactInfos['lastname']){
        $updateLastname = $bdd->prepare('UPDATE contacts SET lastname = :ln WHERE id = :id ;');
        $updateLastname->bindValue(':ln', $newLastname);
        $updateLastname->bindValue(':id', $contactId);
        $updateLastname->execute();
    }

    if($newCodename != $contactInfos['codename']){
        $updateCodename = $bdd->prepare('UPDATE contacts SET codename = :cn WHERE id = :id ;');
        $updateCodename->bindValue(':cn', $newCodename);
        $updateCodename->bindValue(':id', $contactId);
        $updateCodename->execute();
    }

    

    header('location:./contacts.php?update=success');
}