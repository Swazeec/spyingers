<?php

if(!empty($_POST['missionIdToDelete'])){
    $missionId = htmlspecialchars($_POST['missionIdToDelete']);

    // METTRE A JOUR LA/LES CIBLES -> mission_id = null

    # récup toutes les targets dans un tableau
    $targetsReq = $bdd->prepare('SELECT targets.id FROM targets WHERE targets.mission_id = :mid');
    $targetsReq->bindValue(':mid', $missionId);
    $targetsReq->execute();
    $targetsToUpdate= [];
    while($target = $targetsReq->fetch(PDO::FETCH_ASSOC)){
        array_push($targetsToUpdate, $target['id']);
    }

    # MAJ
    foreach($targetsToUpdate as $target){
        $targetUpdate = $bdd->prepare('UPDATE targets SET targets.mission_id = :missionID WHERE targets.id = :id ;');
        $targetUpdate->bindValue(':missionID', null);
        $targetUpdate->bindValue(':id', intVal($target));
        $targetUpdate->execute();
    }
    // METTRE A JOUR LES SAFEHOUSES -> mission_id = null
    
    # récup toutes les safehouses dans un tableau
    $safehousesReq = $bdd->prepare('SELECT safehouses.id FROM safehouses WHERE mission_id = :mid');
    $safehousesReq->bindValue(':mid', $missionId);
    $safehousesReq->execute();
    $safehousesToUpdate = [];
    while($safehouse = $safehousesReq->fetchAll(PDO::FETCH_ASSOC)){
        array_push($safehousesToUpdate, $safehouse['id']);
    }

    # MAJ
    foreach($safehousesToUpdate as $safehouse){
        $safehouseUpdate = $bdd->prepare('UPDATE safehouses SET safehouses.mission_id = :missionID WHERE safehouses.id = :id ;');
        $safehouseUpdate->bindValue(':missionID', null);
        $safehouseUpdate->bindValue(':id', intVal($safehouse));
        $safehouseUpdate->execute();
    }

    // SUPPRIMER LES AGENTS DE LA TABLE AGENTS_MISSIONS
    $deleteAgents = $bdd->prepare('DELETE FROM agents_missions WHERE mission_id = :mid;');
    $deleteAgents->bindValue(':mid', $missionId);
    $deleteAgents->execute();

    // SUPPRIMER LES CONTACTS DE CONTACTS_MISSIONS
    $deleteContacts = $bdd->prepare('DELETE FROM contacts_missions WHERE mission_id = :mid;');
    $deleteContacts->bindValue(':mid', $missionId);
    $deleteContacts->execute();

    // SUPPRIMER LA MISSION
    $deleteMission = $bdd->prepare('DELETE FROM missions WHERE id = :mid');
    $deleteMission->bindValue(':mid', $missionId);
    $deleteMission->execute(); 

    // RENVOYER ACCUEIL

    header('location:./index.php?delete=1');
}