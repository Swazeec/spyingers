<?php

$safehouseId = htmlspecialchars(intval($_GET['safehouse']));

if(
    !empty($_POST['codename']) &&
    !empty($_POST['type']) &&
    !empty($_POST['address']) &&
    !empty($_POST['postalCode']) &&
    !empty($_POST['city'])
){
    // VARIABLES - MODIFICATIONS
    $newCodename = htmlspecialchars($_POST['codename']);
    $newType = htmlspecialchars($_POST['type']);
    $newAddress = htmlspecialchars($_POST['address']);
    $newPostalCode = htmlspecialchars($_POST['postalCode']);
    $newCity = htmlspecialchars($_POST['city']);


    // INFOS DU CONTACT
    $safehouseInfosReq = $bdd->prepare('SELECT * FROM safehouses WHERE id = :id;');
    $safehouseInfosReq->bindValue(':id', $safehouseId);
    $safehouseInfosReq->execute();
    $safehouseInfos = $safehouseInfosReq->fetch(PDO::FETCH_ASSOC);

    // MAJ DE LA TABLE

    if($newCodename != $safehouseInfos['code']){
        $updateCodename = $bdd->prepare('UPDATE safehouses SET code = :code WHERE id = :id ;');
        $updateCodename->bindValue(':code', $newCodename);
        $updateCodename->bindValue(':id', $safehouseId);
        $updateCodename->execute();
    }

    if($newType != $safehouseInfos['SHType_id']){
        $updateType = $bdd->prepare('UPDATE safehouses SET SHType_id = :type WHERE id = :id ;');
        $updateType->bindValue(':type', $newType);
        $updateType->bindValue(':id', $safehouseId);
        $updateType->execute();
    }

    if($newAddress != $safehouseInfos['address']){
        $updateAddress = $bdd->prepare('UPDATE safehouses SET address = :address WHERE id = :id ;');
        $updateAddress->bindValue(':address', $newAddress);
        $updateAddress->bindValue(':id', $safehouseId);
        $updateAddress->execute();
    }

    if($newPostalCode != $safehouseInfos['postalCode']){
        $updatePostalCode = $bdd->prepare('UPDATE safehouses SET postalCode = :pc WHERE id = :id ;');
        $updatePostalCode->bindValue(':pc', $newPostalCode);
        $updatePostalCode->bindValue(':id', $safehouseId);
        $updatePostalCode->execute();
    }

    if($newCity != $safehouseInfos['city']){
        $updateCity = $bdd->prepare('UPDATE safehouses SET city = :city WHERE id = :id ;');
        $updateCity->bindValue(':city', $newCity);
        $updateCity->bindValue(':id', $safehouseId);
        $updateCity->execute();
    }

    header('location:./safehouses.php?update=success');
}