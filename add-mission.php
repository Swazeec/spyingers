<?php
session_start();
if(isset($_SESSION['connect'])){ 
    require_once('./src/db.php');
    require_once('./src/header-connected.php');
    require_once('./src/add-mission-security.php');

?>

<section class="row d-block">

    <!-- entête de la section -->
    <div class="col-12  pt-4 pt-md-5 pb-md-5 mb-3 mb-md-0">
        <h2 class=" text-white text-center pb-3">AJOUTER UNE MISSION</h2>      
        <nav class=" row text-center d-flex justify-content-center">
            <a href="#" class=" col-6 col-md-4 col-lg-2 px-3 fs-5">Ajouter une cible</a>
            <a href="#" class="col-6 col-md-4 col-lg-2 px-3 fs-5">Ajouter un agent</a>
            <a href="#" class="col-6 col-md-4 col-lg-2 px-3 fs-5">Ajouter un contact</a>
        </nav>      
    </div>
    <!-- corps de la section -->
    <div class="col-12">
        <?php
            if(empty($_POST['firstagent'])
            || empty($_POST['contacts'])){


            if(empty($_POST['targets']) 
            || empty($_POST['title'])
            || empty($_POST['status'])
            || empty($_POST['codename'])
            || empty($_POST['country'])
            || empty($_POST['missionType'])
            || empty($_POST['speciality'])
            || empty($_POST['description'])
            || empty($_POST['missionStart'])
            || empty($_POST['missionEnd'])
            || $_POST['missionStart'] > $_POST['missionEnd'])
            { ?>

        <form action="" method="post" class="row p-3 white39 rounded mx-3 " id="addMissionForm">
            <div class="col-12 col-md-4 mb-3 d-flex flex-column" >
                <label for="targets" class="fs-6 fw-bold p-0 m-0">Cible(s)</label>
                <select id="targets" name="targets[]" class="fs-6 text-white p-1 m-0 form-select border-0 white39" required multiple>
                    <?php 
                        $targets = $bdd->prepare('SELECT targets.id, targets.firstname, targets.lastname 
                                                FROM targets 
                                                WHERE targets.mission_id IS NULL;');
                        $targets->execute();
                        while($target = $targets->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option value="<?= $target['id'] ?>"><?= $target['firstname'].' '.$target['lastname'] ?></option>
                        <?php } 
                    ?>
                </select>
            </div>
            <div class="col-12 col-md-8 mb-3 d-flex justify-content-center align-items-center">
                <button type="button" class="btn rounded-pill green39 px-5 text-white fw-bold border-dark"><i class="bi bi-plus"></i> Ajouter une cible ?</button>
            </div>
            <div class="col-12 col-md-8 mb-3 d-flex flex-column" >
                <label for="title" class="fs-6 fw-bold p-0 m-0">Titre de la mission</label>
                <input type="text" id="title" name="title" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></input>
            </div>
            <div class="col-12 col-md-4 mb-3 d-flex flex-column" >
                <label for="status" class="fs-6 fw-bold p-0 m-0">Statut</label>
                <select id="status" name="status" class="fs-6 text-white p-1 m-0 form-select border-0 white39" required>

                    <?php 
                        $allStatus = $bdd->prepare('SELECT status.id, status.name FROM status ');
                        $allStatus->execute();
                        while($status = $allStatus->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option value="<?= $status['id'] ?>"><?= $status['name'] ?></option>
                        <?php } 
                    ?>
                </select>
            </div>
            <div class="col-12 col-md-4 mb-3 d-flex flex-column" >
                <label for="codename" class="fs-6 fw-bold p-0 m-0">Nom de code</label>
                <input type="text" id="codename" name="codename" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></input>
            </div>
            <div class="col-12 col-md-4 mb-3 d-flex flex-column" >
                <label for="country" class="fs-6 fw-bold p-0 m-0">Localisation</label>
                <select id="country" name="country" class="fs-6 text-white p-1 m-0 form-select border-0 white39" required>
                    <?php 
                        $countries = $bdd->prepare('SELECT countries.id, countries.name FROM countries');
                        $countries->execute();
                        while($country = $countries->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option value="<?= $country['id'] ?>"><?= $country['name'] ?></option>
                        <?php } 
                    ?>
                </select>
            </div>
            <div class="col-12 col-md-4 mb-3 d-flex flex-column" >
                <label for="missionType" class="fs-6 fw-bold p-0 m-0">Type de mission</label>
                <select id="missionType" name="missionType" class="fs-6 text-white p-1 m-0 form-select border-0 white39" required>
                    <?php 
                        $missionTypes = $bdd->prepare('SELECT missionTypes.id, missionTypes.name FROM missionTypes');
                        $missionTypes->execute();
                        while($missionType = $missionTypes->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option value="<?= $missionType['id'] ?>"><?= $missionType['name'] ?></option>
                        <?php } 
                    ?>
                </select>
            </div>
            <div class="col-12 col-md-4 mb-3 d-flex flex-column" >
                <label for="speciality" class="fs-6 fw-bold p-0 m-0">Spécialité requise</label>
                <select id="speciality" name="speciality" class="fs-6 text-white p-1 m-0 form-select border-0 white39" required>
                    <?php 
                        $specialities = $bdd->prepare('SELECT specialities.id, specialities.name FROM specialities');
                        $specialities->execute();
                        while($speciality = $specialities->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option value="<?= $speciality['id'] ?>"><?= $speciality['name'] ?></option>
                        <?php } 
                    ?>
                </select>
            </div>
            <div class="col-12 col-md-8 mb-3 d-flex flex-column" >
                <label for="description" class="fs-6 fw-bold p-0 m-0">Description</label>
                <textarea id="description" name="description" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></textarea>
            </div>
            <div class="col-12 col-md-4 mb-3 d-flex flex-column" >
                <label for="missionStart" class="fs-6 fw-bold p-0 m-0">Début de la mission</label>
                <input type="date" id="missionStart" name="missionStart" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></input>
            </div>
            <div class="col-12 col-md-4 mb-3 d-flex flex-column" >
                <label for="missionEnd" class="fs-6 fw-bold p-0 m-0">Fin de la mission</label>
                <input type="date" id="missionEnd" name="missionEnd" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></input>
            </div>
            
            <div class="col-12 col-md-4 d-flex flex-column justify-content-center align-content-end">
                <button type="submit" class="btn rounded-pill bg-success text-white"><i class="bi bi-check2"></i> Valider</button>
            </div>
            
        </form>
                            
        <?php    } else { 
                    $missionInformationsReq = $bdd->prepare('SELECT id, title, speciality_id, country_id FROM missions WHERE id = :id ;');
                    $missionInformationsReq->bindValue(':id', $missionId);
                    $missionInformationsReq->execute();
                    $missionInformations = $missionInformationsReq->fetch(PDO::FETCH_ASSOC);
                    var_dump($missionInformations);
                    ?>

<!-- COMPLETER LA MISSION  // mettre une condition si $_POST contient quelque chose -->
        <form action="" method="post" class="row p-3 white39 rounded mx-3 " id="completeMissionForm">
            <div class="col-12 col-md-4 mb-3" >
                <p class="fs-6 fw-bold p-0 m-0">Mission :</p>
                <p class="fs-6 text-white p-0 m-0"><?php echo $missionInformations['title']  ?></p>
            </div>
            <!-- pour récupérer l'id de la mission à la validation -->
            <div class=" d-none col-12 col-md-4 mb-3" >
                <p class="fs-6 fw-bold p-0 m-0">Mission :</p>
                <input type="text" name="missionId" class="fs-6 text-white p-0 m-0" value="<?php echo $missionInformations['id']  ?>"></input>
            </div>
            <div class="col-12 col-md-4 mb-3" >
                <p class="fs-6 fw-bold p-0 m-0">Cible :</p>
                <p class="fs-6 text-white p-0 m-0"><?php 
                    $targetsReq = $bdd->prepare('SELECT * FROM targets WHERE mission_id = :id ;');
                    $targetsReq->bindValue(':id', $missionInformations['id']);
                    $targetsReq->execute();
                    $targetsNationalities = [];
                    $alltargets = [];
                    while($targetList = $targetsReq->fetch(PDO::FETCH_ASSOC)){
                        array_push($alltargets, $targetList['firstname'].' '.$targetList['lastname']);
                        array_push($targetsNationalities, intVal($targetList['nationality_id']));
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
            <div class="col-12 col-md-4 mb-3" >
                <p class="fs-6 fw-bold p-0 m-0">Spécialité :</p>
                <p class="fs-6 text-white p-0 m-0"><?php 
                    $speReq = $bdd->prepare('SELECT name FROM specialities WHERE id = :id ;');
                    $speReq->bindValue(':id', $missionInformations['speciality_id']);
                    $speReq->execute();
                    $spe = $speReq->fetch(PDO::FETCH_ASSOC);
                    echo $spe['name'];
                ?></p>
            </div>
            <div class="col-12 col-md-4 mb-3 d-flex flex-column" >
                <label for="firstAgent" class="fs-6 fw-bold p-0 m-0">Agent principal</label>
                <select id="firstAgent" name="firstagent" class="fs-6 text-white p-1 m-0 form-select border-0 white39" required>
                    <?php 
                    // ON RECUPERE LES AGENTS JAMAIS ASSIGNES A UNE MISSION ET QUI MATCHENT :
                        $firstAgents = $bdd->prepare('SELECT * FROM agents WHERE id NOT IN (SELECT agent_id FROM agents_missions );');
                            $firstAgents->execute();
                            while($firstAgent = $firstAgents->fetch(PDO::FETCH_ASSOC)){
                                if(!in_array($firstAgent['nationality_id'], $targetsNationalities )){?>

                                
                                <option value="<?= $firstAgent['id'] ?>"><?= $firstAgent['firstname'].' '.$firstAgent['lastname'] ?></option>
                            <?php } } 
                    // ON RECUP LES AGENTS DONT LES MISSIONS SONT FINIES ET DONT LA SPE MATCHE
                        $firstAgentsReq = $bdd->prepare('SELECT agents.id, agents.firstname, agents.lastname, agents.nationality_id, missions.status_id, specialities.name  FROM agents 
                        join agents_missions am ON am.agent_id = agents.id 
                        join missions ON missions.id = am.mission_id 
                        join agents_specialities ON agents_specialities.agent_id = agents.id
                        join specialities ON specialities.id = agents_specialities.speciality_id
                        WHERE missions.status_id >=3 AND specialities.id = :id;');
                        $firstAgentsReq->bindValue(':id', $missionInformations['speciality_id']);
                        $firstAgentsReq->execute();
                        while($firstAgentSTM = $firstAgentsReq->fetch(PDO::FETCH_ASSOC)){
                            if(!in_array($firstAgentSTM['nationality_id'], $targetsNationalities )){?>
                            <option value="<?= $firstAgentSTM['id'] ?>"><?= $firstAgentSTM['firstname'].' '.$firstAgentSTM['lastname'] ?></option>
                        <?php } } 
                        
                    ?>
                </select>
            </div>
            <div class="col-12 col-md-4 mb-3 d-flex flex-column" >
                <label for="contacts" class="fs-6 fw-bold p-0 m-0">Contact(s)</label>
                <select id="contacts" name="contacts[]" class="fs-6 text-white p-1 m-0 form-select border-0 white39" required multiple>
                    <?php 
                        $contacts = $bdd->prepare('SELECT contacts.id, contacts.firstname, contacts.lastname, contacts.nationality_id 
                                                FROM contacts
                                                JOIN nationalities ON nationalities.id = contacts.nationality_id 
                                                WHERE nationalities.country_id  = :idCountry ;');
                        $contacts->bindValue(':idCountry', $missionInformations['country_id']);
                        $contacts->execute();
                        while($contact = $contacts->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option value="<?= $contact['id'] ?>"><?= $contact['firstname'].' '.$contact['lastname'] ?></option>
                        <?php } 
                    ?>
                </select>
            </div>
            <div class="col-12 col-md-4 mb-3 d-flex flex-column" >
                <label for="safehouses" class="fs-6 fw-bold p-0 m-0">Planque(s)</label>
                <select id="safehouses" name="safehouses[]" class="fs-6 text-white p-1 m-0 form-select border-0 white39" multiple>
                    <?php 
                        $safehouses = $bdd->prepare('SELECT safehouses.id, safehouses.code, safehouses.city 
                                                    FROM safehouses
                                                    WHERE safehouses.country_id = :missionCountryId AND safehouses.mission_id IS NULL;');
                        $safehouses->bindValue(':missionCountryId', $missionInformations['country_id']);
                        $safehouses->execute();
                        while($safehouse = $safehouses->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option value="<?= $safehouse['id'] ?>"><?= $safehouse['code'].' ('.$safehouse['city'].')' ?></option>
                        <?php } 
                    ?>
                </select>
            </div>
            <div class="col-12 mt-3">
                <div class="row d-flex flex-column align-content-center">
                    <button type="submit" class=" col-md-4 col-12 btn rounded-pill bg-success text-white"><i class="bi bi-check2"></i> Valider</button>
                </div>
            </div>
        </form>
        <?php }   } else { ?>

<!-- AJOUTER DES AGENTS ? -->
        <form action="" method="post" class="row p-3 white39 rounded mx-3 " id="addOtherAgents">
            <div class=" d-none col-12 col-md-4 mb-3" >
                <p class="fs-6 fw-bold p-0 m-0">ID de mission :</p>
                <input type="text" name="missionId" class="fs-6 text-white p-0 m-0" value="<?php echo $missionId  ?>"></input>
            </div>
            <div class=" d-none col-12 col-md-4 mb-3" >
                <p class="fs-6 fw-bold p-0 m-0">Mission :</p>
                <input type="text" name="missionId" class="fs-6 text-white p-0 m-0" value="<?php echo $missionInformations['id']  ?>"></input>
            </div>
            <div class="col-12 col-md-4 mb-3 d-flex flex-column" >
                <label for="otherAgents" class="fs-6 fw-bold p-0 m-0">Autre(s) agent(s)</label>
                <select id="otherAgents" name="otherAgents" class="fs-6 text-white p-1 m-0 form-select border-0 white39" multiple>
                    <?php 

                    // AGENTS JAMAIS ASSIGNES ET QUI MATCHENT
                        $otherAgents1 = $bdd->prepare('SELECT * 
                                                    FROM agents
                                                    WHERE agents.nationality_id !=1 AND agents.id NOT IN (SELECT agents_missions.agent_id FROM agents_missions);');



                        $otherAgents = $bdd->prepare('SELECT agents.id, agents.firstname, agents.lastname, missions.status_id FROM agents 
                        JOIN agents_missions am ON am.agent_id = agents.id 
                        JOIN missions ON missions.id = am.mission_id 
                        WHERE missions.status_id >=3 ;');
                        $otherAgents->execute();
                        while($otherAgent = $otherAgents->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option value="<?= $otherAgent['id'] ?>"><?= $otherAgent['firstname'].' '.$otherAgent['lastname'] ?></option>
                        <?php } 
                    ?>
                </select>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-center align-content-end">
                <button type="submit" class="btn rounded-pill bg-success text-white"><i class="bi bi-plus"></i> Ajouter le(s) agent(s)</button>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-center align-content-end">
                <a type="button" href="./mission.php?mission=<?= $_POST['missionId'] ?>" class="btn rounded-pill bg-danger text-white" id="noOtherAgent"><i class="bi bi-x"></i> Pas d'autre agent</a>
            </div>
        </form>
        <?php }
        ?>
    </div>
</section>
<!-- espace navigation retour -->
<nav class="row pagination">
    <a href="javascript:history.back()" class="col-12 align-items-center text-white ">
        <i class="bi bi-arrow-left"> retour</i>
    </a>
</nav>
<?php } else {
    header('location:./index.php');
}

require_once ('./src/footer.php');?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>