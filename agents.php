<?php
session_start();
if(isset($_SESSION['connect'])){ 
    require_once('./src/db.php');
    require_once('./src/header-connected.php');
?>


<section class="row d-block">
    <?php
        /* if(!empty($_GET['delete'])){
            $contactToDelete = intval($_GET['delete']);
            $req = $bdd->prepare('DELETE FROM contacts WHERE id = :id');
            $req->bindValue(':id', $contactToDelete);
            $req->execute();
            ?>
            <div class="col-12 bg-success text-white p-3 text-center">
                Contact supprimé avec succès !
            </div>
        <?php
        } */
        /* if(isset($_GET['message']) && $_GET['message'] == 'success'){ ?>
            <div class="col-12 bg-success text-white p-3 text-center">
                Cible ajoutée avec succès !
            </div>
        <?php } */
       /*  if(isset($_GET['update']) && $_GET['update'] == 'success'){ ?>
            <div class="col-12 bg-success text-white p-3 text-center">
                Contact modifié avec succès !
            </div>
        <?php } */
        
    ?>
    <div class="col-12  pt-4 pt-md-5 pb-md-5">
        <h2 class=" text-white text-center pb-3">AGENTS</h2>

        <!-- NAVBAR -->
        <nav class="bg-secondary p-2 navbar navbar-expand-lg navbar-light mb-3 mb-md-0">
            <div class="container-fluid">
                <button class="navbar-toggler mx-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="text-white"><i class="bi bi-plus-circle fs-3"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                        <li class="nav-item">
                            <a href="./agents.php?agents=byName" class="nav-link text-white px-3 fs-6">Trier par nom</a>
                        </li>
                        <li class="nav-item">
                            <a href="./agents.php?agents=byNationality" class="nav-link text-white px-3 fs-6">Trier par nationalité</a>
                        </li>
                        <li class="nav-item">
                            <a href="./agents.php?agents=byId" class="nav-link text-white px-3 fs-6">Trier par date d'ajout</a>
                        </li>
                        <li class="nav-item">
                            <a href="./add-agent.php" class=" nav-link text-white px-3 fs-6 text-nowrap text-decoration-underline"><i class="bi bi-plus"></i> Ajouter un agent</a>
                        </li>
                    </ul>
                </div>
            </div>
            
        </nav>
    </div>
    <div class="col-12">
        <div class="row">
        <?php
            if(isset($_GET['agents']) && $_GET['agents'] == 'byNationality'){
                $req = $bdd->prepare('SELECT agents.id AS id,
                                        agents.firstname AS firstname,
                                        agents.lastname AS lastname,
                                        agents.idcode AS idcode,
                                        nationalities.name AS nationality
                                FROM agents
                                JOIN nationalities ON nationalities.id = agents.nationality_id
                                ORDER BY nationality;
                ');
            } else if (isset($_GET['agents']) && $_GET['agents'] == 'byName') {
                $req = $bdd->prepare('SELECT agents.id AS id,
                                        agents.firstname AS firstname,
                                        agents.lastname AS lastname,
                                        agents.idcode AS idcode,
                                        nationalities.name AS nationality
                                FROM agents
                                JOIN nationalities ON nationalities.id = agents.nationality_id
                                ORDER BY lastname;
                ');
            } else {
                $req = $bdd->prepare('SELECT agents.id AS id,
                                        agents.firstname AS firstname,
                                        agents.lastname AS lastname,
                                        agents.idcode AS idcode,
                                        nationalities.name AS nationality
                                FROM agents
                                JOIN nationalities ON nationalities.id = agents.nationality_id
                                ORDER BY id DESC ;
                ');

            }
            
            if($req->execute()){
                while ($agent = $req->fetch(PDO::FETCH_ASSOC)){ ?>

                    <article class="col-12 col-md-4 col-lg-3 mb-3">
                    <div class="card h-100 white39">
                        <div class="card-body ">
                            <h5 class="card-title fw-bold fs-6 d-flex justify-content-between"><?php echo $agent['firstname'].' '. $agent['lastname']   ?> 
                                <span><a class="btn py-0 text-primary" href="./modify-contact.php?contact=<?= $agent['id'] ?>" ><i class="bi bi-pencil"></i></a>
                                <?php
                                    $countReq = $bdd->prepare('SELECT COUNT(*) AS count FROM agents_missions WHERE agent_id = :aid ;');
                                    $countReq->bindValue(':aid', $agent['id']);
                                    $countReq->execute();
                                    $count = $countReq->fetch(PDO::FETCH_ASSOC);
                                    if($count['count'] == 0){ ?>
                                        <a class="btn py-0 text-danger" href="./contacts.php?delete=<?= $agent['id'] ?>"><i class="bi bi-trash3-fill"></i></a>
                                    <?php } ?>
                                </span>
                            </h5>
                            <h6 class="card-subtitle mb-2 text-white"> Identification : <?php echo $agent['idcode']    ?></h6>
                            <p class="card-text text-white">Nationalité : <?php echo $agent['nationality']    ?></p>
                            <a data-bs-toggle="modal" data-bs-target="#seeMissions<?= $agent['id'] ?>"><u>Voir ses missions</u></a>
                        </div>
                    </div>
                </article>
                <div class="modal fade" id="seeMissions<?= $agent['id'] ?>" tabindex="-1" aria-labelledby="seeMissions" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                
                                <h5 class="modal-title">Missions de <?php echo $agent['firstname'].' '. $agent['lastname']   ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <table class="modal-body table">
                                <tbody>
                                    <?php 
                                    $agentMissionsReq = $bdd->prepare('SELECT missions.id, missions.title, status.name
                                                                        FROM missions
                                                                        JOIN status ON status.id = missions.status_id
                                                                        JOIN contacts_missions ON contacts_missions.mission_id = missions.id
                                                                        WHERE contacts_missions.contact_id = :cid ;');
                                    $agentMissionsReq->bindValue(':cid', $agent['id']);
                                    $agentMissionsReq->execute();
                                    while($agentMission = $agentMissionsReq->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <tr>
                                            <td><?= $agentMission['title'] ?></td>
                                            <td><?= $agentMission['name'] ?></td>
                                            <td><a href="./mission.php?mission=<?= $agentMission['id'] ?>"><i class="bi bi-arrow-right text-dark"></i></a></td>
                                        </tr>
                                    <?php } ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php

                }

            } else {
                echo 'Problème technique temporaire, réessayez plus tard !';
            }
        ?>
        </div>
        
    </div>
    
</section>

<?php require_once ('./src/footer.php'); 
} else {
    header('location:./index.php');
}?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>