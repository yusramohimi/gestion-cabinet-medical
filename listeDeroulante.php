<?php 
require 'database.php';

//  la liste des patients
$statement = $pdo->prepare('SELECT id_patient, nom, prenom FROM patients');
$statement->execute();
$patients = $statement->fetchAll(PDO::FETCH_ASSOC);

// la liste des prestations
$statement = $pdo->prepare('SELECT id_prestation, nom FROM prestations');
$statement->execute();
$prestations = $statement->fetchAll(PDO::FETCH_ASSOC);
