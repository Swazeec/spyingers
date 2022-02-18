<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=spyingers;', 'root','');
} catch (PDOException $e) {
    echo 'Impossible de se connecter à la base de données';
}