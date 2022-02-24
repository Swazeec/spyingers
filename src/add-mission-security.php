<?php


if(empty($_POST['firstagent'])
&& empty($_POST['contacts'])){
    
    if(!empty($_POST['targets']) 
    && !empty($_POST['title'])
    && !empty($_POST['status'])
    && !empty($_POST['codename'])
    && !empty($_POST['country'])
    && !empty($_POST['missionType'])
    && !empty($_POST['speciality'])
    && !empty($_POST['description'])
    && !empty($_POST['missionStart'])
    && !empty($_POST['missionEnd']))
    {
    
        // VARIABLES
        $targets = $_POST['targets'];
        $title = htmlspecialchars( $_POST['title']);
        $status = intval(htmlspecialchars( $_POST['status']));
        $codename = htmlspecialchars( $_POST['codename']);
        $country = intval(htmlspecialchars($_POST['country']));
        $missionType = intval(htmlspecialchars( $_POST['missionType']));
        $speciality = intval(htmlspecialchars( $_POST['speciality']));
        $description = htmlspecialchars( $_POST['description']);
        $missionStart = htmlspecialchars( $_POST['missionStart']);
        $missionEnd = htmlspecialchars( $_POST['missionEnd']);
        
        if($missionStart < $missionEnd){
     
            // AJOUT DES DONNÉES EN BDD
            # création de la mission
            /* $req = $bdd->prepare('INSERT INTO missions (title, description, codename, startDate, endDate, missionType_id, status_id, country_id, speciality_id) 
            VALUES (:title, :description, :codename, :startdate, :enddate, :missionType, :status, :country, :speciality);');
            $req->bindValue(':title', $title);
            $req->bindValue(':description', $description);
            $req->bindValue(':codename', $codename);
            $req->bindValue(':startdate', $missionStart);
            $req->bindValue(':enddate', $missionEnd);
            $req->bindValue(':missionType', $missionType);
            $req->bindValue(':status', $status);
            $req->bindValue(':country', $country);
            $req->bindValue(':speciality', $speciality);
            $req->execute(); */
    
            # update des cibles
            ## on récupère l'id de la mission :
                $missionReq = $bdd->prepare('SELECT * FROM missions WHERE title = :title ORDER BY id DESC LIMIT 1;');
                $missionReq->bindValue(':title', $title);
                $missionReq->execute();
                $missionInfos = $missionReq->fetch(PDO::FETCH_ASSOC);
                $missionId = intVal($missionInfos['id']);
    
            ## on update les targets avec le mission_id :
                foreach($targets as $target){
                    var_dump(intVal($target));
                    $targateUpdate = $bdd->prepare('UPDATE targets SET targets.mission_id = :missionID WHERE targets.id = :id ;');
                    $targateUpdate->bindValue(':missionID', $missionId);
                    $targateUpdate->bindValue(':id', intVal($target));
                    $targateUpdate->execute();
    
            }
        }
    } else {
        // AJOUT DES AGENTS SUPPL.

    }

} else {

// VARIABLES
$missionId = $_POST['missionId'];
$firstAgent = $_POST['firstagent'];
$contacts = $_POST['contacts'];
$safehouses = $_POST['safehouses'];

// ON ASSIGNE L'AGENT PRINCIPAL A LA MISSION

// $insertFirstAgent = $bdd->prepare('INSERT INTO agents_missions (agent_id, mission_id) VALUES (:aid, :mid); ');
// $insertFirstAgent->bindValue(':aid', $firstAgent);
// $insertFirstAgent->bindValue(':mid', $missionId);
// $insertFirstAgent->execute();


// ON ASSIGNE LES CONTACTS A LA MISSION

// $insertContacts = $bdd->prepare('INSERT INTO contacts_missions (contact_id, mission_id) VALUES (:cid, :mid)');
// foreach($contacts as $contact){
//     $insertContacts->bindValue(':mid', $missionId);
//     $insertContacts->bindValue(':cid', $contact);
//     $insertContacts->execute();
// }


// ON ASSIGNE LES PLANQUES A LA MISSION

// if(!empty($safehouses)){
//     $updateSafehouses = $bdd->prepare('UPDATE safehouses SET safehouses.mission_id = :mid WHERE safehouses.id = :sid');
//     $updateSafehouses->bindValue(':mid', $missionId);
//     foreach($safehouses as $safehouse){
//         $updateSafehouses->bindValue(':sid', $safehouse);
//         $updateSafehouses->execute();
//     }
// }

}