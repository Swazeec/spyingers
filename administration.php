<?php
session_start();
require_once('./src/db.php');
require_once('./src/security.php');

// DASHBOARD D'ADMINISTRATION
if(isset($_SESSION['connect'])){ 
    require_once('./src/header-connected.php'); ?>
    <section class="row d-block">
    <div class="col-12  pt-4 pt-md-5 pb-md-5">
            <h2 class=" text-white text-center">ADMINISTRATION</h2>
            <?php
                if(isset($_SESSION['connect'])){ ?>
                <p class="text-white text-center  pb-4">Bienvenue <?= $_SESSION['user'] ?> !</p>
            <?php    }
            ?>
    </div>
    <div class="col-12">
        <article class="row p-3 py-5 white39 rounded mx-0 mx-md-3">
            <div class="col-6 d-none d-md-block text-center">
                <img src="./img/login-illustration.svg" alt="illustration de connexion">
            </div>
            <div class="col-12 col-md-6 d-flex flex-column justify-content-around px-md-5">
                    <a class="rounded-pill white39 text-center text-black p-2 mx-lg-5 my-3 my-md-0" href="./index.php">Les missions</a>
                    <a class="rounded-pill white39 text-center text-black p-2 mx-lg-5 my-3 my-md-0" href="./targets.php">Les cibles</a>
                    <a class="rounded-pill white39 text-center text-black p-2 mx-lg-5 my-3 my-md-0" href="#">Les agents</a>
                    <a class="rounded-pill white39 text-center text-black p-2 mx-lg-5 my-3 my-md-0" href="./contacts.php">Les contacts</a>
                    <a class="rounded-pill white39 text-center text-black p-2 mx-lg-5 my-3 my-md-0" href="#">Les planques</a>
                
            </div>
        </article>
    </div>

    </section>

<!-- ESPACE CONNEXION ADMINS -->
<?php } else {
    require_once('./src/header.php'); ?>
    <section class="row d-block">
    <div class="col-12  pt-4 pt-md-5 pb-md-5">
            <h2 class=" text-white text-center pb-4">CONNEXION</h2>

            <?php
                if(isset($_GET['error']) && $_GET['error'] ==1){ ?>
                    <p class="bg-danger text-white rounded p-3 mx-0 mx-md-3 text-center fw-bold">Identifiants de connexion non reconnus.</p>
                <?php }

            ?>
    </div>
    <div class="col-12 pb-4">
        <article class="row p-3 py-5 white39 rounded mx-0 mx-md-3">

            <!-- illustration -->
            <div class="col-6 d-none d-lg-block text-center">
                <img src="./img/login-illustration.svg" alt="illustration de connexion">
            </div>

            <!-- formulaire de connexion -->
            <div class="col-12 col-lg-6">
                <form action="" method="POST" id="connexion" class="d-flex flex-column mx-md-5">
                    <div class="mb-3 ">
                        <label for="email" class="form-label ">Email</label>
                        <div class="input-group ">
                            <span class="input-group-text border-end-0 bg-white " ><i class="bi bi-envelope"></i></span>
                            <input type="email" required id="email" name="email" placeholder="Votre e-mail" class="border-start-0 form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-white " ><i class="bi bi-lock"></i></span>
                            <input type="password" required name="password"id="password" placeholder="Votre mot de passe" class="border-start-0 form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-red rounded-pill text-white px-5 mt-4" id="lgSubmit">Se connecter</button>
                </form>
            </div>
        </article>
    </div>

    </section>

<?php }
?>


<?php require_once ('./src/footer.php');?>

<script src="./src/scripts/connexion.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>