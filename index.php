<?php
session_start();
require_once('./src/db.php');
if(isset($_SESSION['connect'])){ 
    require_once('./src/header-connected.php');

} else {
    require_once('./src/header.php');
}?>


<section class="row d-block">
    <div class="col-12  pt-4 pt-md-5 pb-md-5">
        <h2 class=" text-white text-center pb-4">MISSIONS</h2>
        <nav class="text-center d-none d-lg-block">
            <a href="./index.php?missions=prep" class="px-3 fs-5">En préparation</a>
            <a href="./index.php?missions=ongoing" class="px-3 fs-5">En cours</a>
            <a href="./index.php?missions=success" class="px-3 fs-5">Terminées</a>
            <a href="./index.php?missions=failed" class="px-3 fs-5">Échecs</a>
            <a href="./index.php?missions=all" class="px-3 fs-5">Toutes les missions</a>
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
                                        ');
                        break;
                }
            } else {
                $req = $bdd->prepare('SELECT missions.id AS idm, missions.title AS title, status.name AS status, countries.name AS country
                                            FROM missions 
                                            JOIN status ON status.id = missions.status_id
                                            JOIN countries ON countries.id = missions.country_id
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