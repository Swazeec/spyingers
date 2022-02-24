<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=spyingers;charset=utf8mb4', 'root','');
} catch (PDOException $e) {
    echo 'Impossible de se connecter à la base de données';
}