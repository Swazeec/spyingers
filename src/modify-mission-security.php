<?php
    $missionID = htmlspecialchars($_GET['mission']);

if(
    !empty($_POST['missionType']) &&
    !empty($_POST['title']) &&
    !empty($_POST['status']) &&
    !empty($_POST['codename']) &&
    !empty($_POST['description']) &&
    !empty($_POST['missionStart']) &&
    !empty($_POST['missionEnd']) 
){

    // VARIABLES = MODIFICATIONS
    $newMissionType = htmlspecialchars($_POST['missionType']);
    $newTitle = htmlspecialchars($_POST['title']);
    $newStatus = htmlspecialchars($_POST['status']);
    $newCodename = htmlspecialchars($_POST['codename']);
    $newDescription = htmlspecialchars($_POST['description']);
    $newStartDate = htmlspecialchars($_POST['missionStart']);
    $newEndDate = htmlspecialchars($_POST['missionEnd']);

    // INFOS DE LA MISSION
    $missionInformationsReq = $bdd->prepare('SELECT * FROM missions WHERE id = :mid ;');
    $missionInformationsReq->bindValue(':mid', $missionID);
    $missionInformationsReq->execute();
    $missionInformations = $missionInformationsReq->fetch(PDO::FETCH_ASSOC);

    if($newStartDate < $newEndDate){
        // MAJ DES TABLES
        if($newMissionType != $missionInformations['missionType_id']){
            $updateMissionType = $bdd->prepare('UPDATE missions SET missionType_id = :mtid WHERE id = :mid ;');
            $updateMissionType->bindValue(':mtid', $newMissionType);
            $updateMissionType->bindValue(':mid', $missionID);
            $updateMissionType->execute();
        } 

        if($newTitle != $missionInformations['title']){
            $updateTitle = $bdd->prepare('UPDATE missions SET title = :title WHERE id = :mid ;');
            $updateTitle->bindValue(':title', $newTitle);
            $updateTitle->bindValue(':mid', $missionID);
            $updateTitle->execute();
        }

        if($newStatus != $missionInformations['status_id']){
            $updateStatus = $bdd->prepare('UPDATE missions SET status_id = :sid WHERE id = :mid ;');
            $updateStatus->bindValue(':sid', $newStatus);
            $updateStatus->bindValue(':mid', $missionID);
            $updateStatus->execute();
        }

        if($newCodename != $missionInformations['codename']){
            $updateCodename = $bdd->prepare('UPDATE missions SET codename = :code WHERE id = :mid ;');
            $updateCodename->bindValue(':code', $newCodename);
            $updateCodename->bindValue(':mid', $missionID);
            $updateCodename->execute();
        }

        if($newDescription != $missionInformations['description']){
            $updateDescr = $bdd->prepare('UPDATE missions SET description = :descr WHERE id = :mid ;');
            $updateDescr->bindValue(':descr', $newDescription);
            $updateDescr->bindValue(':mid', $missionID);
            $updateDescr->execute();
        }

        if($newDescription != $missionInformations['description']){
            $updateDescr = $bdd->prepare('UPDATE missions SET description = :descr WHERE id = :mid ;');
            $updateDescr->bindValue(':descr', $newDescription);
            $updateDescr->bindValue(':mid', $missionID);
            $updateDescr->execute();
        }

        if($newStartDate != $missionInformations['startDate']){
            $updateStart = $bdd->prepare('UPDATE missions SET startDate = :start WHERE id = :mid ;');
            $updateStart->bindValue(':start', $newStartDate);
            $updateStart->bindValue(':mid', $missionID);
            $updateStart->execute();
        }

        if($newEndDate != $missionInformations['endDate']){
            $updateEnd = $bdd->prepare('UPDATE missions SET endDate = :end WHERE id = :mid ;');
            $updateEnd->bindValue(':end', $newEndDate);
            $updateEnd->bindValue(':mid', $missionID);
            $updateEnd->execute();
        }

        # Traiter les planques
        if(!empty($_POST['safehouses'])){
            $newSafehouses = $_POST['safehouses'];
            $missionSafehousesReq = $bdd->prepare('SELECT id FROM safehouses WHERE mission_id = :mid ;');
            $missionSafehousesReq->bindValue(':mid', $missionID);
            $missionSafehousesReq->execute();
            $keptSafehouses = [];
            while($missionSafehouse = $missionSafehousesReq->fetch(PDO::FETCH_ASSOC)){
                if(!in_array($missionSafehouse['id'], $newSafehouses)){
                    $updateSafehousesReq = $bdd->prepare('UPDATE safehouses SET mission_id = NULL WHERE id = :sid ;');
                    $updateSafehousesReq->bindValue(':sid', $missionSafehouse['id']);
                    $updateSafehousesReq->execute();
                } else {
                    array_push($keptSafehouses, $missionSafehouse['id']);
                }
            }
            foreach($newSafehouses as $newSafehouse){
                if(!in_array($newSafehouse, $keptSafehouses)){
                    $addSafehousesReq = $bdd->prepare('UPDATE safehouses SET mission_id = :mid WHERE id = :sid ;');
                    $addSafehousesReq->bindValue(':mid', $missionID);
                    $addSafehousesReq->bindValue(':sid', $newSafehouse);
                    $addSafehousesReq->execute();
                }
            }

        } else {
            $missionSafehousesReq = $bdd->prepare('UPDATE safehouses SET mission_id = NULL WHERE mission_id = :mid ;');
            $missionSafehousesReq->bindValue(':mid', $missionID);
            $missionSafehousesReq->execute();
        }

        # Traiter les agents à ajouter
        if(!empty($_POST['otherAgents'])){
            $otherAgents = $_POST['otherAgents'];

            // AJOUT DES AGENTS SUPPL.
            $insertOtherAgents = $bdd->prepare('INSERT INTO agents_missions (agent_id, mission_id) VALUES (:aid, :mid); ');
            foreach($otherAgents as $otherAgent){
                $insertOtherAgents->bindValue(':mid', $missionID);
                $insertOtherAgents->bindValue(':aid', $otherAgent);
                $insertOtherAgents->execute();
            }
        }

        header('location:./mission.php?mission='.$missionID.'&message=success');
    } else {
        header('location:./modify-mission.php?mission='.$missionID.'&message=error');
    }
} 