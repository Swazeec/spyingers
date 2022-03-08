<?php
session_start();

if(isset($_SESSION['connect'])){ 
    if(!empty($_GET['contact']) && intVal($_GET['contact']) != 0)
    require_once('./src/db.php');
    require_once('./src/modify-contact-security.php');
    require_once('./src/header-connected.php'); 
    $contactId = htmlspecialchars(intVal($_GET['contact']));
    $contactReq = $bdd->prepare('SELECT * FROM contacts 
                                JOIN nationalities ON nationalities.id = contacts.nationality_id
                                WHERE contacts.id = :id');
    $contactReq->bindValue(':id', $contactId);
    $contactReq->execute();
    $contactInfos = $contactReq->fetch(PDO::FETCH_ASSOC);
    ?>
    <section class="row d-block">
        <div class="col-12  pt-4 pt-md-5 pb-md-5">
                <h2 class=" text-white text-center">MODIFIER LE CONTACT</h2>
        </div>
        <div class="col-12">
            <article class="row p-3 py-5 white39 rounded mx-0 mx-md-3">
                <div class="col-6 d-none d-lg-block text-center">
                    <img src="./img/spyingers-contact-ill.svg" alt="illustration de contact">
                </div>
                <div class="col-12 col-lg-6  px-md-5">
                    <form action="" method="post" class="row p-3  rounded " id="modifyContactForm">
                        <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                            <label for="firstname" class="fs-6 fw-bold p-0 m-0">Prénom</label>
                            <input type="text" id="firstname" name="firstname" value="<?= $contactInfos['firstname'] ?>" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></input>
                        </div>
                        <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                            <label for="lastname" class="fs-6 fw-bold p-0 m-0">Nom</label>
                            <input type="text" id="lastname" name="lastname" value="<?= $contactInfos['lastname'] ?>" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></input>
                        </div>
                        <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                            <label for="codename" class="fs-6 fw-bold p-0 m-0">Nom de code</label>
                            <input type="text" id="codename" name="codename" value="<?= $contactInfos['codename'] ?>" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></input>
                        </div>
                        <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                            <label for="nationality" class="fs-6 fw-bold p-0 m-0">Nationalité</label>
                            <p class="text-white"><?= $contactInfos['name'] ?></p>
                        </div>                        
                        
                        <div class="col-12 col-md-4 offset-md-2 d-flex flex-column justify-content-center align-content-end">
                            <button type="submit" id="submit" class="btn rounded-pill bg-success text-white"><i class="bi bi-check2"></i> Valider</button>
                        </div>
                        <div class="col-12 col-md-4 mt-2 mt-md-0 d-flex flex-column ">
                            <a type="button" class="btn rounded-pill bg-danger text-white" href="./contacts.php"><i class="bi bi-x"></i> Annuler</a>
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

<script src="./src/scripts/modify-contact.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>