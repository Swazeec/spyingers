<?php
session_start();
if(isset($_SESSION['connect'])){ 
    require_once('./src/db.php');
    require_once('./src/header-connected.php');
?>


<section class="row d-block">
    <?php
        if(!empty($_GET['delete'])){
            $targetToDelete = intval($_GET['delete']);
            $req = $bdd->prepare('DELETE FROM targets WHERE id = :id');
            $req->bindValue(':id', $targetToDelete);
            $req->execute();
            ?>
            <div class="col-12 bg-success text-white p-3 text-center">
                Cible supprimée avec succès !
            </div>
        <?php
        }
        if(isset($_GET['message']) && $_GET['message'] == 'success'){ ?>
            <div class="col-12 bg-success text-white p-3 text-center">
                Cible ajoutée avec succès !
            </div>
        <?php }
        if(isset($_GET['update']) && $_GET['update'] == 'success'){ ?>
            <div class="col-12 bg-success text-white p-3 text-center">
                Cible modifiée avec succès !
            </div>
        <?php }
        
    ?>
    <div class="col-12  pt-4 pt-md-5 pb-md-5">
        <h2 class=" text-white text-center pb-3">CIBLES</h2>

        <!-- NAVBAR -->
        <nav class="bg-secondary p-2 navbar navbar-expand-lg navbar-light mb-3 mb-md-0">
            <div class="container-fluid">
                <button class="navbar-toggler mx-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="text-white"><i class="bi bi-plus-circle fs-3"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                        <li class="nav-item">
                            <a href="./targets.php?targets=unassigned" class="nav-link text-white px-3 fs-6">Cibles non attribuées</a>
                        </li>
                        <li class="nav-item">
                            <a href="./targets.php?targets=assigned" class="nav-link text-white px-3 fs-6">Cibles attribuées à une mission</a>
                        </li>
                        <li class="nav-item">
                            <a href="./targets.php?targets=all" class="nav-link text-white px-3 fs-6">Toutes les cibles</a>
                        </li>

                        <li class="nav-item">
                            <a href="./add-target.php" class=" nav-link text-white px-3 fs-6 text-nowrap text-decoration-underline"><i class="bi bi-plus"></i> Ajouter une cible</a>
                        </li>
                    </ul>
                </div>
            </div>
            
        </nav>
    </div>
    <div class="col-12">
        <div class="row">
        <?php

            if(isset($_GET['targets']) && $_GET['targets'] != 'all'){
                $statusgetter = array(
                    'unassigned' => 'null',
                    'assigned' => 'not null',
                );
                $bdd->query('SET lc_time_names = \'fr_FR\'');
                $req = $bdd->prepare('SELECT targets.id AS tid,
                                        targets.firstname AS firstname, 
                                        targets.lastname AS lastname, 
                                        targets.codename AS codename, 
                                        DATE_FORMAT(targets.birthdate, "%d/%m/%Y") AS birthdate,
                                        nationalities.name AS nationality, 
                                        missions.id AS mid, 
                                        missions.codename AS mCodename,
                                        status.name AS status
                                FROM targets 
                                JOIN nationalities ON nationalities.id = targets.nationality_id
                                LEFT JOIN missions ON missions.id = targets.mission_id
                                LEFT JOIN status ON status.id = missions.status_id
                                WHERE mission_id is '. $statusgetter[$_GET['targets']]);
            } else{
                $bdd->query('SET lc_time_names = \'fr_FR\'');
                $req = $bdd->prepare('SELECT targets.id AS tid,
                                            targets.firstname AS firstname, 
                                            targets.lastname AS lastname, 
                                            targets.codename AS codename, 
                                            DATE_FORMAT(targets.birthdate, "%d/%m/%Y") AS birthdate,
                                            nationalities.name AS nationality, 
                                            missions.id AS mid, 
                                            missions.title AS mCodename,
                                            status.name AS status
                                    FROM targets 
                                    JOIN nationalities ON nationalities.id = targets.nationality_id
                                    LEFT JOIN missions ON missions.id = targets.mission_id
                                    LEFT JOIN status ON status.id = missions.status_id
                                    ');
            }
            if($req->execute()){
                while ($target = $req->fetch(PDO::FETCH_ASSOC)){ ?>

                    <article class="col-12 col-md-4 col-lg-3 mb-3">
                    <div class="card h-100 white39">
                        <div class="card-body ">
                            <h5 class="card-title fw-bold fs-6 d-flex justify-content-between"><?php echo $target['firstname'].' '. $target['lastname']   ?> 
                                <span><a class="btn py-0 text-primary" href="./modify-target.php?target=<?= $target['tid'] ?>" ><i class="bi bi-pencil"></i></a>
                                <?php
                                    if($target['mid'] === null){ ?>
                                        <a class="btn py-0 text-danger" href="./targets.php?delete=<?= $target['tid'] ?>"><i class="bi bi-trash3-fill"></i></a>
                                    <?php } ?>
                                </span>
                            </h5>
                            <h6 class="card-subtitle mb-2 text-white"> Nom de code : <?php echo $target['codename']    ?></h6>
                            <p class="card-text text-white">Naissance : <?php echo $target['birthdate']    ?></p>
                            <p class="card-text text-white">Nationalité : <?php echo $target['nationality']    ?></p>
                            
                        </div>
                        <div class="card-footer border-0 bg-grey">
                            <?php
                                if($target['mid'] === null){ ?>
                                    <p class="card-text text-white pb-0 mb-0">Mission : aucune</p><br>
                                    
                                <?php } else { ?>
                                    <p class="card-text text-primary pb-0 mb-0"><a href="./mission.php?mission=<?php echo $target['mid']?>" class="card-link ">Mission : <?php echo $target['mCodename'] ?>   </a></p>
                                    <p class="card-text text-primary status"><?php echo $target['status'] ?></p>
                                <?php }
                            ?>
                        </div>
                    </div>
                </article>
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

<script src="./src/scripts/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>