<?php
session_start();

if(isset($_SESSION['connect'])){ 
    if(!empty($_GET['agent']) && intVal($_GET['agent']) != 0){
        require_once('./src/db.php');
        $agentId = htmlspecialchars(intVal($_GET['agent']));
        $agentReq = $bdd->prepare('SELECT * FROM agents 
                                    JOIN nationalities ON nationalities.id = agents.nationality_id
                                    WHERE agents.id = :id');
        $agentReq->bindValue(':id', $agentId);
        $agentReq->execute();
        $count = $agentReq->rowCount();
        if($count == 0){
            header('location:./agents.php?error=invalid');
        } else {
            require_once('./src/modify-agent-security.php');
            require_once('./src/header-connected.php'); 
            $agentInfos = $agentReq->fetch(PDO::FETCH_ASSOC);
            ?>
            <section class="row d-block">
                <div class="col-12  pt-4 pt-md-5 pb-md-5">
                        <h2 class=" text-white text-center">MODIFIER L'AGENT</h2>
                </div>
                <div class="col-12">
                    <article class="row p-3 py-5 white39 rounded mx-0 mx-md-3">
                        <div class="col-6 my-auto d-none d-lg-block text-center">
                            <img src="./img/spyingers-agent-ill.svg" alt="illustration d'agent">
                        </div>
                        <div class="col-12 col-lg-6  px-md-5">
                            <form action="" method="post" class="row p-3  rounded " id="modifyAgentForm">
                                <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                                    <label for="firstname" class="fs-6 fw-bold p-0 m-0">Prénom</label>
                                    <input type="text" id="firstname" name="firstname" value="<?= $agentInfos['firstname'] ?>" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></input>
                                </div>
                                <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                                    <label for="lastname" class="fs-6 fw-bold p-0 m-0">Nom</label>
                                    <input type="text" id="lastname" name="lastname" value="<?= $agentInfos['lastname'] ?>" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></input>
                                </div>
                                <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                                    <label for="birthDate" class="fs-6 fw-bold p-0 m-0">Date de naissance</label>
                                    <input type="date" id="birthDate" name="birthDate" value="<?= $agentInfos['birthdate'] ?>" class="fs-6 text-white p-1 m-0 form-control border-0 white39" required></input>
                                </div> 
                                <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                                    <label for="nationality" class="fs-6 fw-bold p-0 m-0">Nationalité</label>
                                    <p class="text-white"><?= $agentInfos['name'] ?></p>
                                </div>    
                                <div class="col-12 mb-3 d-flex flex-column" >
                                    <label for="codename" class="fs-6 fw-bold p-0 m-0">Code d'identification</label>
                                    <p id="idcode" class="text-white " ><?= $agentInfos['idcode'] ?></p>
                                </div>
                                <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                                    <label for="specialities" class="fs-6 fw-bold p-0 m-0">Spécialité(s)</label>
                                    <p class="text-white">
                                        <?php 
                                        $specialities = [];
                                        $specialitiesReq = $bdd->prepare('SELECT specialities.name 
                                                                        FROM specialities 
                                                                        JOIN agents_specialities ON agents_specialities.speciality_id = specialities.id 
                                                                        WHERE agents_specialities.agent_id = :aid ;');
                                        $specialitiesReq->bindValue(':aid', $agentId);
                                        $specialitiesReq->execute();
                                        while($speciality = $specialitiesReq->fetch(PDO::FETCH_ASSOC)){
                                            array_push($specialities, $speciality['name']);
                                        }
                                        for($i = 0 ; $i < count($specialities) ; $i++){
                                            if($specialities[$i] == end($specialities)){
                                                echo $specialities[$i];
                                            } else {
                                                echo $specialities[$i].', ';
                                            }
                                        } ?>    
                                    </p>
                                </div>
                                <div class="col-12 col-md-6 mb-3 d-flex flex-column" >
                                    <label for="addSpecialities" class="fs-6 fw-bold p-0 m-0">Ajouter des spécialités ?</label>
                                    <select id="addSpecialities" name="addSpecialities[]" class="fs-6 text-white p-1 m-0 form-select border-0 white39" multiple>
                                        <?php 
                                            $addSpecialities = $bdd->prepare('SELECT specialities.id, specialities.name FROM specialities');
                                            $addSpecialities->execute();
                                            while($specialityToAdd = $addSpecialities->fetch(PDO::FETCH_ASSOC)){ 
                                                if(!in_array($specialityToAdd['name'], $specialities)){
                                                    ?>
                                                    <option value="<?= $specialityToAdd['id'] ?>"><?= $specialityToAdd['name'] ?></option>
                                                <?php } 

                                            }
                                        ?>
                                    </select>
                                </div>     
                                                    
                                
                                <div class="col-12 col-md-4 offset-md-2 d-flex flex-column justify-content-center align-content-end">
                                    <button type="submit" id="submit" class="btn rounded-pill bg-success text-white"><i class="bi bi-check2"></i> Valider</button>
                                </div>
                                <div class="col-12 col-md-4 mt-2 mt-md-0 d-flex flex-column ">
                                    <a type="button" class="btn rounded-pill bg-danger text-white" href="./agents.php"><i class="bi bi-x"></i> Annuler</a>
                                </div>
                                
                            </form>
                        </div>
                    </article>
                </div>

            </section>

            <?php require_once ('./src/footer.php'); 
        }
    } else {
        header('location:./agents.php?error=invalid');
    }
} else {
    header('location:./index.php');
}
?>

<script src="./src/scripts/modify-agent.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>