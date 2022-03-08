<?php
if(
    !empty($_POST['firstname']) &&
    !empty($_POST['lastname']) &&
    !empty($_POST['birthDate']) &&
    !empty($_POST['nationality']) &&
    !empty($_POST['specialities'])
){
    // VARIABLES
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $birthDate = htmlspecialchars($_POST['birthDate']);
    $nationalityId = htmlspecialchars($_POST['nationality']);
    $specialities = $_POST['specialities'] ;


    // REQUETE

    $agentsReq = $bdd->prepare('INSERT INTO agents (idcode, firstname, lastname, birthdate, nationality_id) VALUES (uuid(), :fn, :ln, :bdate, :nid);');
    $agentsReq->bindValue(':fn', $firstname);
    $agentsReq->bindValue(':ln', $lastname);
    $agentsReq->bindValue(':bdate', $birthDate);
    $agentsReq->bindValue(':nid', $nationalityId);
    $agentsReq->execute();

    $agentIdReq = $bdd->prepare('SELECT agents.id FROM agents WHERE firstname = :fn AND lastname = :ln ORDER BY id DESC LIMIT 1 ;');
    $agentIdReq->bindValue(':fn', $firstname);
    $agentIdReq->bindValue(':ln', $lastname);
    $agentIdReq->execute();
    $agentId = $agentIdReq->fetch(PDO::FETCH_ASSOC);
    
    foreach($specialities as $speciality){
        if(intval($speciality) !=0){
            $agentSpecReq = $bdd->prepare('INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (:aid, :sid);');
            $agentSpecReq->bindValue(':aid', $agentId['id']);
            $agentSpecReq->bindValue(':sid', $speciality);
            $agentSpecReq->execute();
        } else {
            header('location:./agents.php?message=error');
        }

    }

    header('location:./agents.php?message=success');
} 