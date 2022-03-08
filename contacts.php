<?php
session_start();
if(isset($_SESSION['connect'])){ 
    require_once('./src/db.php');
    require_once('./src/header-connected.php');
?>


<section class="row d-block">
    <?php
        /* if(!empty($_GET['delete'])){
            $targetToDelete = intval($_GET['delete']);
            $req = $bdd->prepare('DELETE FROM targets WHERE id = :id');
            $req->bindValue(':id', $targetToDelete);
            $req->execute();
            ?>
            <div class="col-12 bg-success text-white p-3 text-center">
                Cible supprimée avec succès !
            </div>
        <?php
        } */
        if(isset($_GET['message']) && $_GET['message'] == 'success'){ ?>
            <div class="col-12 bg-success text-white p-3 text-center">
                Cible ajoutée avec succès !
            </div>
        <?php }
        if(isset($_GET['update']) && $_GET['update'] == 'success'){ ?>
            <div class="col-12 bg-success text-white p-3 text-center">
                Contact modifié avec succès !
            </div>
        <?php }
        
    ?>
    <div class="col-12  pt-4 pt-md-5 pb-md-5">
        <h2 class=" text-white text-center pb-3">CONTACTS</h2>

        <!-- NAVBAR -->
        <nav class="bg-secondary p-2 navbar navbar-expand-lg navbar-light mb-3 mb-md-0">
            <div class="container-fluid">
                <button class="navbar-toggler mx-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="text-white"><i class="bi bi-plus-circle fs-3"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                        <li class="nav-item">
                            <a href="./contacts.php?contacts=byNationality" class="nav-link text-white px-3 fs-6">Trier par nationalité</a>
                        </li>
                        <li class="nav-item">
                            <a href="./contacts.php?contacts=byId" class="nav-link text-white px-3 fs-6">Trier par date d'ajout</a>
                        </li>
                        <li class="nav-item">
                            <a href="./add-contact.php" class=" nav-link text-white px-3 fs-6 text-nowrap text-decoration-underline"><i class="bi bi-plus"></i> Ajouter un contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            
        </nav>
    </div>
    <div class="col-12">
        <div class="row">
        <?php

            if(isset($_GET['contacts']) && $_GET['contacts'] != 'byId'){
                $req = $bdd->prepare('SELECT contacts.id AS id,
                                        contacts.firstname AS firstname,
                                        contacts.lastname AS lastname,
                                        contacts.codename AS codename,
                                        nationalities.name AS nationality
                                FROM contacts
                                JOIN nationalities ON nationalities.id = contacts.nationality_id
                                ORDER BY nationality;
                ');
            } else {
                $req = $bdd->prepare('SELECT contacts.id AS id,
                                        contacts.firstname AS firstname,
                                        contacts.lastname AS lastname,
                                        contacts.codename AS codename,
                                        nationalities.name AS nationality
                                FROM contacts
                                JOIN nationalities ON nationalities.id = contacts.nationality_id
                                ORDER BY id DESC ;
                ');

            }
            
            if($req->execute()){
                while ($contact = $req->fetch(PDO::FETCH_ASSOC)){ ?>

                    <article class="col-12 col-md-4 col-lg-3 mb-3">
                    <div class="card h-100 white39">
                        <div class="card-body ">
                            <h5 class="card-title fw-bold fs-6 d-flex justify-content-between"><?php echo $contact['firstname'].' '. $contact['lastname']   ?> 
                                <span><a class="btn py-0 text-primary" href="./modify-contact.php?contact=<?= $contact['id'] ?>" ><i class="bi bi-pencil"></i></a>
                                <!-- <?php
                                    if($target['mid'] === null){ ?>
                                        <a class="btn py-0 text-danger" href="./targets.php?delete=<?= $target['tid'] ?>"><i class="bi bi-trash3-fill"></i></a>
                                    <?php } ?> -->
                                </span>
                            </h5>
                            <h6 class="card-subtitle mb-2 text-white"> Nom de code : <?php echo $contact['codename']    ?></h6>
                            <p class="card-text text-white">Nationalité : <?php echo $contact['nationality']    ?></p>
                            <a data-bs-toggle="modal" data-bs-target="#seeMissions<?= $contact['id'] ?>"><u>Voir ses missions</u></a>
                        </div>
                    </div>
                </article>
                <div class="modal fade" id="seeMissions<?= $contact['id'] ?>" tabindex="-1" aria-labelledby="seeMissions" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                
                                <h5 class="modal-title">Missions de <?php echo $contact['firstname'].' '. $contact['lastname'].' ('.$contact['codename'].')'   ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <table class="modal-body table">
                                <tbody>
                                    <?php 
                                    $contactMissionsReq = $bdd->prepare('SELECT missions.id, missions.title, status.name
                                                                        FROM missions
                                                                        JOIN status ON status.id = missions.status_id
                                                                        JOIN contacts_missions ON contacts_missions.mission_id = missions.id
                                                                        WHERE contacts_missions.contact_id = :cid ;');
                                    $contactMissionsReq->bindValue(':cid', $contact['id']);
                                    $contactMissionsReq->execute();
                                    while($contactMission = $contactMissionsReq->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <tr>
                                            <td><?= $contactMission['title'] ?></td>
                                            <td><?= $contactMission['name'] ?></td>
                                            <td><a href="./mission.php?mission=<?= $contactMission['id'] ?>"><i class="bi bi-arrow-right text-dark"></i></a></td>
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