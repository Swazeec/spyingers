<?php
session_start();
require_once('./src/db.php');
if(isset($_SESSION['connect'])){ 
    require_once('./src/header-connected.php');

} else {
    require_once('./src/header.php');
}
?>

<section class="row d-block">
<?php
############# ATTENTION !! IL FAUT TRAITER LES ID INEXISTANTS !!!!!!!!!!!
// function checkValidMission($requestID){
//     $lastmissionID = $bdd->prepare('SELECT id FROM missions WHERE id .$requestID;');
//     $lastmissionID->execute();
//     return $lastmissionID->rowCount(); 
// }


    $lastmissionID = $bdd->prepare('SELECT id FROM missions ORDER BY id DESC LIMIT 1;');
    $lastmissionID->execute();
    
    if(!isset($_GET['mission']) || is_int($_GET['mission']) || $_GET['mission'] > $lastmissionID){
        header('location:./index.php');
    } else {
        $missionID = htmlspecialchars($_GET['mission']);
        $bdd->query('SET lc_time_names = \'fr_FR\'');
        $req = $bdd->prepare(
            'SELECT  missions.title AS title, 
                    status.name AS status, 
                    missions.codename AS codename , 
                    countries.name AS country, 
                    missionTypes.name AS type, 
                    specialities.name AS speciality,
                    missions.description AS description,
                    DATE_FORMAT(missions.startDate, "%d %M %Y") AS startDate,
                    DATE_FORMAT(missions.endDate, "%d %M %Y") AS endDate,
                    targets.codename AS Tcodename
            FROM missions
                JOIN status ON status.id = missions.status_id 
                JOIN countries ON countries.id = missions.country_id 
                JOIN missionTypes ON missionTypes.id = missions.missionType_id 
                JOIN specialities ON specialities.id = missions.speciality_id 
                JOIN targets ON targets.mission_id = missions.id
            WHERE missions.id = :id
                ');
        $req->bindValue(':id', $missionID, PDO::PARAM_INT);
        if($req->execute()){
            $missionDetail = $req->fetch(PDO::FETCH_ASSOC); 

            // Récupérer les cibles d'une mission
            $targets = $bdd->prepare('SELECT targets.codename AS Tcodename
                                        FROM targets
                                        WHERE targets.mission_id = :id
            ');
            $targets->bindValue(':id', $missionID, PDO::PARAM_INT);
            $targets->execute();

            // Récupérer les agents d'une mission
            $agents = $bdd->prepare('SELECT agents.firstname AS firstname, agents.lastname AS lastname
                                        FROM agents
                                        JOIN agents_missions ON agents_missions.agent_id = agents.id
                                        WHERE agents_missions.mission_id = :id
            ');
            $agents->bindValue(':id', $missionID, PDO::PARAM_INT);
            $agents->execute();

            // Récupérer les contacts d'une mission
            $contacts = $bdd->prepare('SELECT contacts.codename AS codename
                                    FROM contacts
                                    JOIN contacts_missions ON contacts_missions.contact_id = contacts.id
                                    WHERE contacts_missions.mission_id = :id
            ');
            $contacts->bindValue(':id', $missionID, PDO::PARAM_INT);
            $contacts->execute();

            // Récupérer les planques d'une mission
            $safehouses = $bdd->prepare('SELECT safehouses.code AS safehouse, safehouses.city AS city
                                    FROM safehouses
                                    JOIN missions ON missions.id = safehouses.mission_id
                                    WHERE missions.id = :id
            ');
            $safehouses->bindValue(':id', $missionID, PDO::PARAM_INT);
            $safehouses->execute();

            ?>
            

    <!-- entête de la section -->
    <div class="col-12  pt-4 pt-md-5 pb-md-5 mb-3 mb-md-0">
        <h2 class=" text-white text-center pb-3"><?php echo mb_strtoupper($missionDetail['title'])  ?> </h2>      
        <div class="row mr-auto d-flex justify-content-center ">
            <p class="col-8 col-md-4 rounded-pill blue39 text-center p-1" id="status"><?php echo $missionDetail['status']  ?></p>
        </div>      
    </div>
    <!-- corps de la section -->
    <div class="col-12 ">
        <article class="row p-3 white39 rounded mx-3">
            <div class="col-12 col-md-4 mb-3" >
                <p class="fs-6 fw-bold p-0 m-0">Nom de code</p>
                <p class="fs-6 text-white p-0 m-0"><?php echo $missionDetail['codename']  ?></p>
            </div>
            <div class="col-12 col-md-4 mb-3" >
                <p class="fs-6 fw-bold p-0 m-0">Localisation</p>
                <p class="fs-6 text-white p-0 m-0"><?php echo $missionDetail['country']  ?></p>
            </div>
            <div class="col-12 col-md-4 mb-3" >
                <p class="fs-6 fw-bold p-0 m-0">Type de mission</p>
                <p class="fs-6 text-white p-0 m-0"><?php echo $missionDetail['type']  ?></p>
            </div>
            <div class="col-12 col-md-4 mb-3" >
                <p class="fs-6 fw-bold p-0 m-0">Spécialité requise</p>
                <p class="fs-6 text-white p-0 m-0"><?php echo $missionDetail['speciality']  ?></p>
            </div>
            <div class="col-12 col-md-8 mb-3" >
                <p class="fs-6 fw-bold p-0 m-0">Description</p>
                <p class="fs-6 text-white p-0 m-0"><?php echo $missionDetail['description']  ?></p>
            </div>
            <div class="col-12 col-md-4 mb-3" >
                <p class="fs-6 fw-bold p-0 m-0">Cible(s)</p>
                <p class="fs-6 text-white p-0 m-0"><?php
                    while ($target = $targets->fetch(PDO::FETCH_ASSOC)){
                        echo $target['Tcodename'].' <br> ';
                    } ?></p>
            </div>
            <div class="col-12 col-md-4 mb-3" >
                <p class="fs-6 fw-bold p-0 m-0">Agent(s)</p>
                <p class="fs-6 text-white p-0 m-0"><?php
                    while ($agent = $agents->fetch(PDO::FETCH_ASSOC)){
                        echo $agent['firstname']. ' '.$agent['lastname'].' <br> ';
                    } ?></p>
            </div>
            <div class="col-12 col-md-4 mb-3" >
                <p class="fs-6 fw-bold p-0 m-0">Contact(s)</p>
                <p class="fs-6 text-white p-0 m-0"><?php
                    while ($contact = $contacts->fetch(PDO::FETCH_ASSOC)){
                        echo $contact['codename'].' <br> ';
                    } ?></p>
            </div>
            <div class="col-12 col-md-4 mb-3" >
                <p class="fs-6 fw-bold p-0 m-0">Planque(s)</p>
                <p class="fs-6 text-white p-0 m-0"><?php
                    while ($safehouse = $safehouses->fetch(PDO::FETCH_ASSOC)){
                        echo $safehouse['safehouse'].' -- '.$safehouse['city'].' <br> ';
                    } ?></p>

            </div><div class="col-12 col-md-4 mb-3" >
                <p class="fs-6 fw-bold p-0 m-0">Début de la mission</p>
                <p class="fs-6 text-white p-0 m-0"><?php echo $missionDetail['startDate']  ?></p>
            </div><div class="col-12 col-md-4 mb-3" >
                <p class="fs-6 fw-bold p-0 m-0">Fin de la mission</p>
                <p class="fs-6 text-white p-0 m-0"><?php echo $missionDetail['endDate']  ?></p>
            </div>
            
        </article>
    </div>
    <?php    
        } else {
            
            header('location:./index.php');
        }

    }
?>
</section>
<!-- espace navigation retour -->
<nav class="row pagination ">
    <a href="javascript:history.back()" class="col-12 align-items-center text-white ">
        <i class="bi bi-arrow-left"> retour</i>
    </a>
</nav>
<?php require_once ('./src/footer.php');?>

<script src="./src/scripts/missionDetails.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>