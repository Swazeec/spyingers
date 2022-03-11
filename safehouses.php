<?php
session_start();
if(isset($_SESSION['connect'])){ 
    require_once('./src/db.php');
    require_once('./src/header-connected.php');
?>


<section class="row d-block">
    <?php
        if(!empty($_GET['delete'])){
            $safehouseToDelete = intval($_GET['delete']);
            
            $req = $bdd->prepare('DELETE FROM safehouses WHERE id = :id');
            $req->bindValue(':id', $safehouseToDelete);
            $req->execute();
            ?>
            <div class="col-12 bg-success text-white p-3 text-center">
                Planque supprimée avec succès !
            </div>
        <?php
        }
        if(isset($_GET['message']) && $_GET['message'] == 'success'){ ?>
            <div class="col-12 bg-success text-white p-3 text-center">
                Planque ajoutée avec succès !
            </div>
        <?php } else if (isset($_GET['message']) && $_GET['message'] == 'error'){ ?>
            <div class="col-12 bg-danger text-white p-3 text-center">
                Un problème est survenu lors de la création de votre planque. Veuillez supprimer et recommencer.
            </div>
        <?php }
        if(isset($_GET['update']) && $_GET['update'] == 'success'){ ?>
            <div class="col-12 bg-success text-white p-3 text-center">
                Planque modifiée avec succès !
            </div>
        <?php }
        
        if(isset($_GET['error']) && $_GET['error'] == 'invalid'){ ?>
            <div class="col-12 bg-danger text-white p-3 text-center">
                La planque demandée est invalide.
            </div>
        <?php }
        
    ?>
    <div class="col-12  pt-4 pt-md-5 pb-md-5">
        <h2 class=" text-white text-center pb-3">PLANQUES</h2>

        <!-- NAVBAR -->
        <nav class="bg-secondary p-2 navbar navbar-expand-lg navbar-light mb-3 mb-md-0">
            <div class="container-fluid">
                <button class="navbar-toggler mx-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="text-white"><i class="bi bi-plus-circle fs-3"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                        <li class="nav-item">
                            <a href="./safehouses.php?safehouses=byCountry" class="nav-link text-white px-3 fs-6">Trier par pays</a>
                        </li>
                        <li class="nav-item">
                            <a href="./safehouses.php?safehouses=byId" class="nav-link text-white px-3 fs-6">Trier par date d'ajout</a>
                        </li>
                        <li class="nav-item">
                            <a href="./safehouses.php?safehouses=byAvailability" class="nav-link text-white px-3 fs-6">Planques disponibles</a>
                        </li>
                        <li class="nav-item">
                            <a href="./safehouses.php?safehouses=all" class="nav-link text-white px-3 fs-6">Toutes les planques</a>
                        </li>
                        <li class="nav-item">
                            <a href="./add-safehouse.php" class=" nav-link text-white px-3 fs-6 text-nowrap text-decoration-underline"><i class="bi bi-plus"></i> Ajouter une planque</a>
                        </li>
                    </ul>
                </div>
            </div>
            
        </nav>
    </div>
    <div class="col-12">
        <div class="row">
        <?php
            if(isset($_GET['safehouses']) && $_GET['safehouses'] == 'byAvailability'){
                $req = $bdd->prepare('SELECT safehouses.id AS id, 
                                            safehouses.code AS code, 
                                            safehouses.address, 
                                            safehouses.postalCode, 
                                            safehouses.city, 
                                            safehouses.mission_id, 
                                            safehousetypes.name AS safehouseType, 
                                            countries.name AS country,
                                            missions.status_id
                                    FROM safehouses
                                    JOIN safehousetypes ON safehousetypes.id = safehouses.SHType_id 
                                    JOIN countries ON countries.id = safehouses.country_id 
                                    LEFT JOIN missions ON missions.id = safehouses.mission_id
                                    WHERE missions.status_id IS NULL OR missions.status_id > 2
                                    ORDER BY country;
                ');
            } else if (isset($_GET['safehouses']) && $_GET['safehouses'] == 'byCountry') {
                $req = $bdd->prepare('SELECT safehouses.id AS id, 
                                            safehouses.code AS code, 
                                            safehouses.address, 
                                            safehouses.postalCode, 
                                            safehouses.city, 
                                            safehouses.mission_id, 
                                            safehousetypes.name AS safehouseType, 
                                            countries.name AS country,
                                            missions.status_id
                                    FROM safehouses
                                    JOIN safehousetypes ON safehousetypes.id = safehouses.SHType_id 
                                    JOIN countries ON countries.id = safehouses.country_id 
                                    LEFT JOIN missions ON missions.id = safehouses.mission_id
                                    ORDER BY country;
                ');
            } else {
                $req = $bdd->prepare('SELECT safehouses.id AS id, 
                                            safehouses.code AS code, 
                                            safehouses.address, 
                                            safehouses.postalCode, 
                                            safehouses.city, 
                                            safehouses.mission_id, 
                                            safehousetypes.name AS safehouseType, 
                                            countries.name AS country,
                                            missions.status_id
                                    FROM safehouses
                                    JOIN safehousetypes ON safehousetypes.id = safehouses.SHType_id 
                                    JOIN countries ON countries.id = safehouses.country_id
                                    LEFT JOIN missions ON missions.id = safehouses.mission_id
                                    ORDER BY id DESC;
                ');

            }
            
            if($req->execute()){
                while ($safehouse = $req->fetch(PDO::FETCH_ASSOC)){ ?>

                    <article class="col-12 col-md-4 col-lg-3 mb-3">
                    <div class="card h-100 white39">
                        <div class="card-body ">
                            <h5 class="card-title fw-bold fs-6 d-flex justify-content-between"><?php echo $safehouse['code']  ?> 
                                <span>
                                    <a class="btn py-0 text-primary" href="./modify-safehouse.php?safehouse=<?= $safehouse['id'] ?>" ><i class="bi bi-pencil"></i></a>
                                    <a class="btn py-0 text-danger" href="./safehouses.php?delete=<?= $safehouse['id'] ?>"><i class="bi bi-trash3-fill"></i></a>
                                </span>
                            </h5>
                            <h6 class="card-subtitle mb-2 text-white">Adresse :</h6>
                            <p class="card-text text-white p-0 m-0"><?php echo $safehouse['address'] ?></p>
                            <p class="card-text text-white p-0 m-0"><?php echo $safehouse['postalCode'].' '. $safehouse['city']   ?></p>
                            <p class="card-text text-white pt-0 mt-0"><?php echo $safehouse['country'] ?></p>
                            <p class="card-text text-white"> Type : <?php echo $safehouse['safehouseType'] ?></p>
                            <?php
                                if($safehouse['mission_id'] == null || $safehouse['status_id'] > 2){ ?>
                                    <p class="card-text text-success">Planque disponible</p>
                                <?php } else { ?>
                                    <a href="./mission.php?mission=<?php echo $safehouse['mission_id'] ?>"><u>Voir la mission en cours</u></a>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>