<?php
session_start();

if(isset($_SESSION['connect'])){ 
    if(!empty($_GET['safehouse']) && intVal($_GET['safehouse']) != 0){
        require_once('./src/db.php');
        $safehouseId = htmlspecialchars(intVal($_GET['safehouse']));
        $safehouseReq = $bdd->prepare('SELECT * FROM safehouses 
                                    JOIN countries ON countries.id = safehouses.country_id
                                    WHERE safehouses.id = :id');
        $safehouseReq->bindValue(':id', $safehouseId);
        $safehouseReq->execute();
        $count = $safehouseReq->rowCount();
        if($count == 0){
            header('location:./safehouse.php?error=invalid');
        } else {
            require_once('./src/modify-safehouse-security.php');
            require_once('./src/header-connected.php'); 
            $safehouseInfos = $safehouseReq->fetch(PDO::FETCH_ASSOC);
            ?>
            <section class="row d-block">
                <div class="col-12  pt-4 pt-md-5 pb-md-5">
                        <h2 class=" text-white text-center">MODIFIER LA PLANQUE</h2>
                </div>
                <div class="col-12">
                    <article class="row p-3 py-5 white39 rounded mx-0 mx-md-3">
                        <div class="col-6 d-none d-lg-block text-center">
                            <img src="./img/spyingers-safehouse-ill.svg" alt="illustration de planque">
                        </div>
                        <div class="col-12 col-lg-6  px-md-5">
                            <form action="" method="post" class="row p-3  rounded " id="modifySafehouseForm">
                                <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                                    <label for="codename" class="fs-6 fw-bold p-0 m-0">Nom de code</label>
                                    <input type="text" id="codename" name="codename" value="<?= $safehouseInfos['code'] ?>" class="fs-6 text-white p-1 m-0 form-control border-0 white39"required ></input>
                                </div>
                                <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                                    <label for="type" class="fs-6 fw-bold p-0 m-0">Type</label>
                                    <select id="type" name="type" class="fs-6 text-white p-1 m-0 form-select border-0 white39" required>
                                        <?php 
                                            $SHTypes = $bdd->prepare('SELECT safehouseTypes.id, safehouseTypes.name FROM safehouseTypes ;');
                                            $SHTypes->execute();
                                            while($safehouseType = $SHTypes->fetch(PDO::FETCH_ASSOC)){ ?>
                                                <option value="<?= $safehouseType['id'] ?>"><?= $safehouseType['name'] ?></option>
                                            <?php } 
                                        ?>
                                    </select>
                                </div> 
                                <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                                    <label for="address" class="fs-6 fw-bold p-0 m-0">Adresse</label>
                                    <input type="text" id="address" name="address" value="<?= $safehouseInfos['address'] ?>" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></input>
                                </div>
                                <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                                    <label for="postalCode" class="fs-6 fw-bold p-0 m-0">Code postal</label>
                                    <input type="text" id="postalCode" name="postalCode" value="<?= $safehouseInfos['postalCode'] ?>" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></input>
                                </div>
                                <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                                    <label for="city" class="fs-6 fw-bold p-0 m-0">Ville</label>
                                    <input type="text" id="city" name="city" value="<?= $safehouseInfos['city'] ?>" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></input>
                                </div>  
                                <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                                    <p class="fs-6 fw-bold p-0 m-0">Pays</p>
                                    <p id="city" class="fs-6 text-white p-1 m-0 " required><?= $safehouseInfos['name'] ?></p>
                                </div>                      
                                
                                <div class="col-12 col-md-4 offset-md-2 d-flex flex-column justify-content-center align-content-end">
                                    <button type="submit" id="submit" class="btn rounded-pill bg-success text-white"><i class="bi bi-check2"></i> Valider</button>
                                </div>
                                <div class="col-12 col-md-4 mt-2 mt-md-0 d-flex flex-column ">
                                    <a type="button" class="btn rounded-pill bg-danger text-white" href="./safehouses.php"><i class="bi bi-x"></i> Annuler</a>
                                </div>
                                
                            </form>
                        </div>
                    </article>
                </div>

            </section>

            <?php require_once ('./src/footer.php');
        }
    } else {
        header('location:./safehouse.php?error=invalid');
    }
} else {
    header('location:./index.php');
}
?>

<script src="./src/scripts/modify-safehouse.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>