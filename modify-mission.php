<?php
session_start();
if(isset($_SESSION['connect'])){ 
    require_once('./src/db.php');
    if(!empty($_GET['mission']) && intVal($_GET['mission']) != 0){
        require_once('./src/modify-mission-security.php');
        require_once('./src/header-connected.php');
        $missionId = htmlspecialchars($_GET['mission']);  ?>

        <section class="row d-block">
        <?php 
            if(isset($_GET['message']) && $_GET['message'] == 'error'){ ?>
                <div class="col-12 bg-danger text-white p-3 text-center">
                    Un problème est survenu. Merci de remplir correctement les informations !
                </div>


            <?php }
        ?>
            <!-- entête de la section -->
            <div class="col-12  pt-4 pt-md-5 pb-md-5 mb-3 mb-md-0">
                <h2 class=" text-white text-center pb-3">MODIFIER LA MISSION</h2>      
            </div>
            <!-- corps de la section -->
            <div class="col-12">
                
                <form action="" method="post" class="row p-3 white39 rounded mx-3 " id="modifyMissionForm">
                    <!-- CIBLES -->
                    <div class="col-12 col-md-4 mb-3" >
                        <p class="fs-6 fw-bold p-0 m-0">Cible(s) :</p>
                        <p class="fs-6 text-white p-0 m-0"><?php 
                            $targetsReq = $bdd->prepare('SELECT * FROM targets WHERE mission_id = :id ;');
                            $targetsReq->bindValue(':id', $missionId);
                            $targetsReq->execute();
                            $alltargets = [];
                            while($targetList = $targetsReq->fetch(PDO::FETCH_ASSOC)){
                                array_push($alltargets, $targetList['firstname'].' '.$targetList['lastname']);
                            }; 
                            for($i = 0 ; $i < count($alltargets) ; $i++){
                                if($alltargets[$i] == end($alltargets)){
                                    echo $alltargets[$i];
                                } else {
                                    echo $alltargets[$i].', ';
                                }
                            }
                        ?></p>
                    </div>
                    <!-- LOCALISATION -->
                    <div class="col-12 col-md-4 mb-3" >
                        <p class="fs-6 fw-bold p-0 m-0">Localisation</p>
                        <p class="fs-6 text-white p-0 m-0">
                            <?php 
                                $countryReq = $bdd->prepare('SELECT name FROM countries JOIN missions ON missions.country_id = countries.id WHERE missions.id = :id ;');
                                $countryReq->bindValue(':id', $missionId);
                                $countryReq->execute();
                                $country = $countryReq->fetch(PDO::FETCH_ASSOC);
                                echo $country['name'];?>
                        </p>
                    </div>
                    <!-- SPECIALITE REQUISE -->
                    <div class="col-12 col-md-4 mb-3" >
                        <p class="fs-6 fw-bold p-0 m-0">Spécialité requise</p>
                        <p class="fs-6 text-white p-0 m-0">
                            <?php 
                            $speReq = $bdd->prepare('SELECT specialities.name FROM specialities JOIN missions ON missions.speciality_id = specialities.id WHERE missions.id = :mid ;');
                            $speReq->bindValue(':mid', $missionId);
                            $speReq->execute();
                            $speciality = $speReq->fetch(PDO::FETCH_ASSOC);
                            echo $speciality['name']                            ;
                            ?>
                        </p>
                    </div>
                    <!-- AGENTS -->
                    <div class="col-12 col-md-4 mb-3" >
                        <p class="fs-6 fw-bold p-0 m-0">Agent(s)</p>
                        <p class="fs-6 text-white p-0 m-0"><?php
                        // Récupérer les agents d'une mission
                        $agents = $bdd->prepare('SELECT agents.firstname AS firstname, agents.lastname AS lastname
                        FROM agents
                        JOIN agents_missions ON agents_missions.agent_id = agents.id
                        WHERE agents_missions.mission_id = :id
                        ');
                        $agents->bindValue(':id', $missionId, PDO::PARAM_INT);
                        $agents->execute();
                            while ($agent = $agents->fetch(PDO::FETCH_ASSOC)){
                                echo $agent['firstname']. ' '.$agent['lastname'].' <br> ';
                            } ?></p>
                    </div>
                    <!-- CONTACTS -->
                    <div class="col-12 col-md-4 mb-3" >
                        <p class="fs-6 fw-bold p-0 m-0">Contact(s) :</p>
                        <p class="fs-6 text-white p-0 m-0"><?php 
                            $contactsReq = $bdd->prepare('SELECT contacts.firstname, contacts.lastname 
                                                        FROM contacts 
                                                        JOIN contacts_missions ON contacts_missions.contact_id = contacts.id
                                                        WHERE contacts_missions.mission_id = :id ;');
                            $contactsReq->bindValue(':id', $missionId);
                            $contactsReq->execute();
                            $allContacts = [];
                            while($contactList = $contactsReq->fetch(PDO::FETCH_ASSOC)){
                                array_push($allContacts, $contactList['firstname'].' '.$contactList['lastname']);
                            }; 
                            for($i = 0 ; $i < count($allContacts) ; $i++){
                                if($allContacts[$i] == end($allContacts)){
                                    echo $allContacts[$i];
                                } else {
                                    echo $allContacts[$i].', ';
                                }
                            }
                        ?></p>
                    </div>
                    <!-- TYPE DE MISSION -->
                    <div class="col-12 col-md-4 mb-3 d-flex flex-column" >
                        <label for="missionType" class="fs-6 fw-bold p-0 m-0">Type de mission</label>
                        <select id="missionType" name="missionType" class="fs-6 text-white p-1 m-0 form-select border-0 white39" required>
                            <?php
                                $missionTypeReq = $bdd->prepare('SELECT missionType_id FROM missions WHERE id = :mid;');
                                $missionTypeReq->bindValue(':mid', $missionId);
                                $missionTypeReq->execute();
                                $currentMissionType = $missionTypeReq->fetch(PDO::FETCH_ASSOC);

                                $allMissionTypes = $bdd->prepare('SELECT missionTypes.id, missionTypes.name FROM missionTypes');
                                $allMissionTypes->execute();
                                while($missionType = $allMissionTypes->fetch(PDO::FETCH_ASSOC)){ 
                                    if($missionType['id'] == $currentMissionType['missionType_id']){ ?>
                                        <option value="<?= $missionType['id'] ?>" selected><?= $missionType['name'] ?></option>
                                    <?php }
                                } 
                                $allMissionTypes->execute();
                                while($missionType = $allMissionTypes->fetch(PDO::FETCH_ASSOC)){ 
                                    if($missionType['id'] != $currentMissionType['missionType_id']){ ?>
                                        <option value="<?= $missionType['id'] ?>"><?= $missionType['name'] ?></option>
                                    <?php }
                                }
                            ?>
                        </select>
                    </div>
                    <!-- TITRE -->
                    <div class="col-12 col-md-8 mb-3 d-flex flex-column" >
                        <label for="title" class="fs-6 fw-bold p-0 m-0">Titre de la mission : </label>
                            <?php 
                            $titleReq = $bdd->prepare('SELECT title FROM missions WHERE id = :id ;');
                            $titleReq->bindValue(':id', $missionId);
                            $titleReq->execute();
                            $title = $titleReq->fetch(PDO::FETCH_ASSOC);?>
                        <input type="text" id="title" name="title" class="fs-6 text-white p-1 m-0 form-control border-0 white39" placeholder="Nouveau titre" required value="<?= $title['title']  ?>"></input>
                    </div>
                    <!-- STATUT -->
                    <div class="col-12 col-md-4 mb-3 d-flex flex-column" >
                        <label for="status" class="fs-6 fw-bold p-0 m-0">Statut</label>
                        <select id="status" name="status" class="fs-6 text-white p-1 m-0 form-select border-0 white39" required>
                            <?php 
                                $missionStatusReq = $bdd->prepare('SELECT status_id FROM missions WHERE id = :mid;');
                                $missionStatusReq->bindValue(':mid', $missionId);
                                $missionStatusReq->execute();
                                $missionStatus = $missionStatusReq->fetch(PDO::FETCH_ASSOC);
                                $allStatus = $bdd->prepare('SELECT id, name FROM status ');
                                $allStatus->execute();
                                while($status = $allStatus->fetch(PDO::FETCH_ASSOC)){ 
                                    if($missionStatus['status_id'] == $status['id']){ ?>
                                        <option value="<?= $status['id'] ?>" selected><?= $status['name'] ?></option>
                                    <?php }   
                                } 
                                $allStatus->execute();
                                while($status = $allStatus->fetch(PDO::FETCH_ASSOC)){ 
                                    if($missionStatus['status_id'] != $status['id']){ ?>
                                        <option value="<?= $status['id'] ?>"><?= $status['name'] ?></option>
                                    <?php }  
                                } 
                            ?>
                        </select>
                    </div>
                    <!-- NOM DE CODE -->
                    <div class="col-12 col-md-4 mb-3 d-flex flex-column" >
                        <label for="codename" class="fs-6 fw-bold p-0 m-0">Nom de code</label>
                        <?php 
                            $codenameReq = $bdd->prepare('SELECT codename FROM missions WHERE id = :id ;');
                            $codenameReq->bindValue(':id', $missionId);
                            $codenameReq->execute();
                            $codename = $codenameReq->fetch(PDO::FETCH_ASSOC);?>
                        <input type="text" id="codename" name="codename" class="fs-6 text-white p-1 m-0 form-control border-0 white39" placeholder="Nouveau nom de code" required value="<?= $codename['codename']  ?>"></input>
                    </div>
                    <!-- DESCRIPTION -->
                    <div class="col-12 col-md-8 mb-3 d-flex flex-column" >
                        <label for="description" class="fs-6 fw-bold p-0 m-0">Description</label>
                        <?php 
                            $descReq = $bdd->prepare('SELECT description FROM missions WHERE id = :mid ;');
                            $descReq->bindValue(':mid', $missionId);
                            $descReq->execute();
                            $description = $descReq->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <textarea id="description" name="description" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required><?php echo $description['description'] ?></textarea>
                    </div>
                    <!-- DATES -->
                    <?php 
                        $missionDatesReq = $bdd->prepare('SELECT startDate, endDate FROM missions WHERE id = :mid;');
                        $missionDatesReq->bindValue(':mid', $missionId);
                        $missionDatesReq->execute();
                        $missionDates = $missionDatesReq->fetch(PDO::FETCH_ASSOC);
                    ?>

                    <div class="col-12 col-md-4 mb-3 d-flex flex-column " >
                        <div>
                            <label for="missionStart" class="fs-6 fw-bold p-0 m-0">Début de la mission</label>
                            <input type="date" id="missionStart" name="missionStart" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required value="<?= $missionDates['startDate'] ; ?>" ></input>
                        </div>
                        <div class="mt-3">
                            <label for="missionEnd" class="fs-6 fw-bold p-0 m-0">Fin de la mission</label>
                            <input type="date" id="missionEnd" name="missionEnd" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required value="<?= $missionDates['endDate'] ; ?>" ></input>
                        </div>
                    </div>
                    <!-- <div class="col-12 col-md-4 mb-3 d-flex flex-column" > -->
                        <!-- <label for="missionEnd" class="fs-6 fw-bold p-0 m-0">Fin de la mission</label>
                        <input type="date" id="missionEnd" name="missionEnd" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required value="<?= $missionDates['endDate'] ; ?>" ></input> -->
                    <!-- </div> -->

                    <!-- PLANQUES -->
                    <div class="col-12 col-md-4 mb-3 d-flex flex-column" >
                        <label for="safehouses" class="fs-6 fw-bold p-0 m-0">Planque(s)</label>
                        <select id="safehouses" name="safehouses[]" class="fs-6 text-white p-1 m-0 form-select border-0 white39" multiple>
                            <?php 
                                $missionSafehousesReq = $bdd->prepare('SELECT safehouses.id, safehouses.code, safehouses.city 
                                                                       FROM safehouses
                                                                       WHERE safehouses.mission_id = :mid;');
                                $missionSafehousesReq->bindValue(':mid', $missionId);
                                $missionSafehousesReq->execute();
                                while($missionSafehouse = $missionSafehousesReq->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <option value="<?= $missionSafehouse['id'] ?>" selected="selected"><?= $missionSafehouse['code'].' ('.$missionSafehouse['city'].')'?></option>
                                <?php } 
                                $missionCountry = $bdd->prepare('SELECT country_id FROM missions WHERE id = :mid');
                                $missionCountry->bindValue(':mid', $missionId);
                                $missionCountry->execute();
                                $country = $missionCountry->fetch(PDO::FETCH_ASSOC);
                                $safehouses = $bdd->prepare('SELECT safehouses.id, safehouses.code, safehouses.city 
                                                            FROM safehouses
                                                            WHERE safehouses.country_id = :missionCountryId AND safehouses.mission_id IS NULL;');
                                $safehouses->bindValue(':missionCountryId', $country['country_id']);
                                $safehouses->execute();
                                while($safehouse = $safehouses->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <option value="<?= $safehouse['id'] ?>"><?= $safehouse['code'].' ('.$safehouse['city'].')' ?></option>
                                <?php } 
                            ?>
                        </select>
                    </div>
                    <!-- AJOUTER DES AGENTS -->
                    <div class="col-12 col-md-4 mb-3 d-flex flex-column">
                        <label for="otherAgents" class="fs-6 fw-bold p-0 m-0">Ajouter d'autre(s) agent(s)</label>
                        <select id="otherAgents" name="otherAgents[]" class="fs-6 text-white p-1 m-0 form-select border-0 white39" multiple>
                            <?php 
                            // RECUP NATIONALITE DES CIBLES 
                            $targetNationalities=[];
                            $getTargetsNationalities = $bdd->prepare('SELECT targets.nationality_id FROM targets WHERE targets.mission_id = :mid');
                            $getTargetsNationalities->bindValue(':mid', $missionId);
                            $getTargetsNationalities->execute();
                            while($targetNationality = $getTargetsNationalities->fetch(PDO::FETCH_ASSOC)){
                                array_push($targetNationalities, intVal($targetNationality['nationality_id']));
                            }

                            // AGENTS JAMAIS ASSIGNES ET QUI MATCHENT
                                $newAgents = $bdd->prepare('SELECT * FROM agents WHERE id NOT IN (SELECT agent_id FROM agents_missions );');
                                $newAgents->execute();
                                while($newAgent = $newAgents->fetch(PDO::FETCH_ASSOC)){ 
                                    if(!in_array($newAgent['nationality_id'], $targetNationalities )){?>

                                    <option value="<?= $newAgent['id'] ?>"><?= $newAgent['firstname'].' '.$newAgent['lastname'] ?></option>
                                <?php } }  


                            // AGENTS DONT LES MISSIONS SONT TERMINEES ET QUI MATCHENT
                                $otherAgents = $bdd->prepare('SELECT agents.id, agents.firstname, agents.lastname, agents.nationality_id, missions.status_id FROM agents 
                                JOIN agents_missions am ON am.agent_id = agents.id 
                                JOIN missions ON missions.id = am.mission_id 
                                WHERE missions.status_id >=3;');
                                $otherAgents->execute();
                                while($otherAgent = $otherAgents->fetch(PDO::FETCH_ASSOC)){ 
                                    $allMissionStatus = [];
                                    if(!in_array($otherAgent['nationality_id'], $targetNationalities)){
                                        $allMissionsReq = $bdd->prepare('SELECT missions.status_id 
                                                                        FROM missions
                                                                        JOIN agents_missions ON agents_missions.mission_id = missions.id
                                                                        WHERE agents_missions.agent_id = :aid ;');
                                        $allMissionsReq->bindValue(':aid', $otherAgent['id']);
                                        $allMissionsReq->execute();
                                        while($missionStatus = $allMissionsReq->fetch(PDO::FETCH_ASSOC)){
                                            array_push($allMissionStatus, $missionStatus['status_id']);
                                        }
                                        if(!in_array(1, $allMissionStatus) && !in_array(2, $allMissionStatus)){
                                            ?>
                                        <option value="<?= $otherAgent['id'] ?>"><?= $otherAgent['firstname'].' '.$otherAgent['lastname'] ?></option>
                                    <?php
                                        }
                                    }

                                }  
                            ?>
                        </select>
                        
                    </div>

                    <div class="col-12 col-md-4 offset-md-2 d-flex flex-column ">
                        <button type="submit" class="btn rounded-pill bg-success text-white"><i class="bi bi-check2"></i> Valider</button>
                    </div>
                    <div class="col-12 col-md-4 mt-2 mt-md-0 d-flex flex-column ">
                        <a type="button" class="btn rounded-pill bg-danger text-white" href="./mission.php?mission=<?= $missionId ?>"><i class="bi bi-x"></i> Annuler</a>
                    </div>
                </form>

                    
            </div>
        </section>

    <?php } else {
        header('location:./index.php?error=invalid');
        /* require_once('./src/modify-mission-security.php');
        require_once('./src/header-connected.php'); */
    }
} else {
    // header('location:./index.php');
}

require_once ('./src/footer.php');?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>