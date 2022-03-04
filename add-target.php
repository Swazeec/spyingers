<?php
session_start();

// DASHBOARD D'ADMINISTRATION
if(isset($_SESSION['connect'])){ 
    // require_once('./src/security.php');
    require_once('./src/db.php');
    require_once('./src/header-connected.php'); ?>
    <section class="row d-block">
        <div class="col-12  pt-4 pt-md-5 pb-md-5">
                <h2 class=" text-white text-center">AJOUTER UNE CIBLE</h2>
        </div>
        <div class="col-12">
            <article class="row p-3 py-5 white39 rounded mx-0 mx-md-3">
                <div class="col-6 d-none d-lg-block text-center">
                    <img src="./img/target-illustration.svg" alt="illustration de cible">
                </div>
                <div class="col-12 col-lg-6  px-md-5">
                    <form action="" method="post" class="row p-3  rounded " id="addTargetForm">
                        <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                            <label for="firstname" class="fs-6 fw-bold p-0 m-0">Prénom</label>
                            <input type="text" id="firstname" name="firstname" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></input>
                        </div>
                        <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                            <label for="lastname" class="fs-6 fw-bold p-0 m-0">Nom</label>
                            <input type="text" id="lastname" name="lastname" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></input>
                        </div>
                        <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                            <label for="codename" class="fs-6 fw-bold p-0 m-0">Nom de code</label>
                            <input type="text" id="codename" name="codename" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></input>
                        </div>
                        <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                            <label for="birthDate" class="fs-6 fw-bold p-0 m-0">Date de naissance</label>
                            <input type="date" id="birthDate" name="birthDate" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></input>
                        </div>
                        <div class="col-12 mb-3 d-flex flex-column" >
                            <label for="nationality" class="fs-6 fw-bold p-0 m-0">Nationalité</label>
                            <select id="nationality" name="nationality" class="fs-6 text-white p-1 m-0 form-select border-0 white39" required>
                                <?php 
                                    $nationalities = $bdd->prepare('SELECT nationalities.id, nationalities.name FROM nationalities');
                                    $nationalities->execute();
                                    while($nationality = $nationalities->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <option value="<?= $nationality['id'] ?>"><?= $nationality['name'] ?></option>
                                    <?php } 
                                ?>
                            </select>
                        </div>                        
                        
                        <div class="col-12 col-md-4 offset-md-4 d-flex flex-column justify-content-center align-content-end">
                            <button type="submit" id="submit" class="btn rounded-pill bg-success text-white"><i class="bi bi-check2"></i> Valider</button>
                        </div>
                        
                    </form>
                </div>
            </article>
        </div>

    </section>

    <?php require_once ('./src/footer.php');?>
<?php } else {
    header('location:./index.php');
}
?>

<script src="./src/scripts/add-target.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>