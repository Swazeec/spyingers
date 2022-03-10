<?php

$agentId = htmlspecialchars(intval($_GET['agent']));

if(
    !empty($_POST['firstname']) &&
    !empty($_POST['lastname']) &&
    !empty($_POST['birthDate'])
){
    // VARIABLES - MODIFICATIONS
    $newFirstname = htmlspecialchars($_POST['firstname']);
    $newLastname = htmlspecialchars($_POST['lastname']);
    $newBirthDate = htmlspecialchars($_POST['birthDate']);
    $specialitiesToAdd = $_POST['addSpecialities'];


    // INFOS DE L'AGENT
    $agentInfosReq = $bdd->prepare('SELECT * FROM agents WHERE id = :id;');
    $agentInfosReq->bindValue(':id', $agentId);
    $agentInfosReq->execute();
    $agentInfos = $agentInfosReq->fetch(PDO::FETCH_ASSOC);

    // MAJ DE LA TABLE

    if($newFirstname != $agentInfos['firstname']){
        $updateFirstname = $bdd->prepare('UPDATE agents SET firstname = :fn WHERE id = :id ;');
        $updateFirstname->bindValue(':fn', $newFirstname);
        $updateFirstname->bindValue(':id', $agentId);
        $updateFirstname->execute();
    }

    if($newLastname != $agentInfos['lastname']){
        $updateLastname = $bdd->prepare('UPDATE agents SET lastname = :ln WHERE id = :id ;');
        $updateLastname->bindValue(':ln', $newLastname);
        $updateLastname->bindValue(':id', $agentId);
        $updateLastname->execute();
    }

    if($newBirthDate != $agentInfos['birthdate']){
        $updateBirthDate = $bdd->prepare('UPDATE agents SET birthdate = :bDate WHERE id = :id ;');
        $updateBirthDate->bindValue(':bDate', $newBirthDate);
        $updateBirthDate->bindValue(':id', $agentId);
        $updateBirthDate->execute();
    }

    if(!empty($specialitiesToAdd)){
        foreach($specialitiesToAdd as $speciality){
            if(intval($speciality) !=0){
                $agentSpecReq = $bdd->prepare('INSERT INTO agents_specialities (agent_id, speciality_id) VALUES (:aid, :sid);');
                $agentSpecReq->bindValue(':aid', $agentId);
                $agentSpecReq->bindValue(':sid', $speciality);
                $agentSpecReq->execute();
            } else {
                header('location:./agents.php?update=error');
            }
        }
    }

    

    header('location:./agents.php?update=success');
}