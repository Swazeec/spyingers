<?php
if(
    !empty($_POST['codename']) &&
    !empty($_POST['type']) &&
    !empty($_POST['address']) &&
    !empty($_POST['postalCode']) &&
    !empty($_POST['city']) &&
    !empty($_POST['country'])
){
    // VARIABLES
    $codename = htmlspecialchars($_POST['codename']);
    $type = htmlspecialchars($_POST['type']);
    $address = htmlspecialchars($_POST['address']);
    $postalCode = htmlspecialchars($_POST['postalCode']);
    $city = htmlspecialchars($_POST['city']);
    $country = htmlspecialchars($_POST['country']);


    // REQUETE

    $safehouseReq = $bdd->prepare('INSERT INTO safehouses (code, address, postalCode, city, SHType_id, country_id, mission_id) 
                                                VALUES (:code, :address, :postalCode, :city, :type, :country, null);');
    $safehouseReq->bindValue(':code', $codename);
    $safehouseReq->bindValue(':address', $address);
    $safehouseReq->bindValue(':postalCode', $postalCode);
    $safehouseReq->bindValue(':city', $city);
    $safehouseReq->bindValue(':type', $type);
    $safehouseReq->bindValue(':country', $country);
    if($safehouseReq->execute()){
        header('location:./safehouses.php?message=success');
    } else {
        header('location:./safehouses.php?message=error');
    }
    

} 