<?php
session_start();
require_once('./src/db.php');
if(isset($_SESSION['connect'])){ 
    require_once('./src/header-connected.php');
} else {
    require_once('./src/header.php');
}?>


<section class="row d-block">
    <?php
    if(isset($_SESSION['connect'])){
        if(isset($_GET['delete']) && $_GET['delete'] == 1){ ?>
            <div class="col-12 bg-success text-white p-3 text-center">
                Mission supprimée avec succès !
            </div>


        <?php }
    }
        
    ?>
    <div class="col-12  pt-4 pt-md-5 pb-md-5">
        <h2 class=" text-white text-center pb-3">MISSIONS</h2>

        <!-- <nav class="text-center bg-secondary rounded-pill p-2 d-none d-md-block">
            <a href="./index.php?missions=prep" class=" px-3 fs-6">En préparation</a>
            <a href="./index.php?missions=ongoing" class="px-3 fs-6">En cours</a>
            <a href="./index.php?missions=success" class="px-3 fs-6">Terminées</a>
            <a href="./index.php?missions=failed" class="px-3 fs-6">Échecs</a>
            <a href="./index.php?missions=all" class="px-3 fs-6">Toutes les missions</a>
            <?php 
            if(isset($_SESSION['connect'])){ ?>
            <a href="./add-mission.php" class="px-3 fs-6 text-nowrap text-decoration-underline"><i class="bi bi-plus"></i> Ajouter une mission</a>
            
            <?php }
            ?>
        </nav> -->

        <!-- NAVBAR -->
        <nav class="bg-secondary p-2 navbar navbar-expand-lg navbar-light mb-3 mb-md-0">
            <div class="container-fluid">
                <button class="navbar-toggler mx-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="text-white"><i class="bi bi-plus-circle fs-3"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                        <li class="nav-item">
                            <a href="./index.php?missions=prep" class="nav-link text-white px-3 fs-6">En préparation</a>
                        </li>
                        <li class="nav-item">
                            <a href="./index.php?missions=ongoing" class="nav-link text-white px-3 fs-6">En cours</a>
                        </li>
                        <li class="nav-item">
                            <a href="./index.php?missions=success" class="nav-link text-white px-3 fs-6">Terminées</a>
                        </li>
                        <li class="nav-item">
                            <a href="./index.php?missions=failed" class="nav-link text-white px-3 fs-6">Échecs</a>
                        </li>
                        <li class="nav-item">
                            <a href="./index.php?missions=all" class="nav-link text-white px-3 fs-6">Toutes les missions</a>
                        </li>
                        <?php if(isset($_SESSION['connect'])){ ?>  
                        <li class="nav-item">
                            <a href="./add-mission.php" class=" nav-link text-white px-3 fs-6 text-nowrap text-decoration-underline"><i class="bi bi-plus"></i> Ajouter une mission</a>
                        </li>
                        <?php }
                        ?>
                    </ul>
                </div>
            </div>
            
        </nav>
    </div>
    <div class="col-12">
        <div class="row">
        <?php
            if(isset($_GET['missions'])){
                switch($_GET['missions']) {
                    case 'prep' :
                        $req = $bdd->prepare('SELECT missions.id AS idm, missions.title AS title, status.id, status.name AS status, countries.name AS country
                                        FROM missions 
                                        JOIN status ON status.id = missions.status_id
                                        JOIN countries ON countries.id = missions.country_id
                                        WHERE status.id = 1');
                        break;
                    case 'ongoing' :
                        $req = $bdd->prepare('SELECT missions.id AS idm, missions.title AS title, status.id, status.name AS status, countries.name AS country
                                        FROM missions 
                                        JOIN status ON status.id = missions.status_id
                                        JOIN countries ON countries.id = missions.country_id
                                        WHERE status.id = 2');
                        break;
                    case 'success' :
                        $req = $bdd->prepare('SELECT missions.id AS idm, missions.title AS title, status.id, status.name AS status, countries.name AS country
                                        FROM missions 
                                        JOIN status ON status.id = missions.status_id
                                        JOIN countries ON countries.id = missions.country_id
                                        WHERE status.id = 3');
                        break;
                    case 'failed' :
                        $req = $bdd->prepare('SELECT missions.id AS idm, missions.title AS title, status.id , status.name AS status, countries.name AS country
                                        FROM missions 
                                        JOIN status ON status.id = missions.status_id
                                        JOIN countries ON countries.id = missions.country_id
                                        WHERE status.id = 4');
                        break;
                    case 'all' :
                    default:
                        $req = $bdd->prepare('SELECT missions.id AS idm, missions.title AS title, status.name AS status, countries.name AS country
                                        FROM missions 
                                        JOIN status ON status.id = missions.status_id
                                        JOIN countries ON countries.id = missions.country_id
                                        order by missions.startDate desc
                                        ');
                        break;
                }
            } else {
                $req = $bdd->prepare('SELECT missions.id AS idm, missions.title AS title, status.name AS status, countries.name AS country
                                            FROM missions 
                                            JOIN status ON status.id = missions.status_id
                                            JOIN countries ON countries.id = missions.country_id
                                            order by missions.startDate desc
                                            ');
            }
                if ($req->execute()){
                    while ($mission = $req->fetch(PDO::FETCH_ASSOC)){ ?>

                        <article class="col-12 col-md-4 col-lg-3 mb-3">
                        <div class="card white39">
                            <div class="d-flex align-items-center">
    
                                <div class="card-body">
                                    <h5 class="card-title fw-bold fs-6"><?php echo $mission['title']    ?> </h5>
                                    <h6 class="card-subtitle mb-2 text-white"><?php echo $mission['country']    ?></h6>
                                    <p class="card-text text-primary status"><?php echo $mission['status']    ?></p>
                                </div>
                                <!-- id = id de la mission -->
                                <a href="./mission.php?mission=<?php echo $mission['idm']?>" class="card-link pe-3 fs-2 fw-bold"><i class="bi bi-arrow-right"></i></a>
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
<nav class="row pagination">
    <div class="col-12 ">
        <p class=" text-center text-white">
            insérer ici la pagination si besoin
        </p> 
    </div>
</nav>
<?php require_once ('./src/footer.php'); ?>

<script src="./src/scripts/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>