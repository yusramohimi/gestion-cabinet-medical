<?php
require "database.php";
// patients du mois
$statement = $pdo -> prepare("SELECT COUNT(DISTINCT id_patient) AS nombre_patients_ce_mois
FROM rendez_vous
WHERE MONTH(date_heure) = MONTH(NOW()) AND YEAR(date_heure) = YEAR(NOW())");
$statement -> execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
$nombre_patients_ce_mois = $result['nombre_patients_ce_mois'];


// revenu d aujourd'hui
$statement = $pdo -> prepare("SELECT SUM(montant) AS total_revenus_aujourd_hui
FROM factures
WHERE DATE(date_emission) = CURDATE()");
$statement -> execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
$total_revenus_aujourd_hui = $result['total_revenus_aujourd_hui'];


// nombre des rendez-vous confirmés pour aujourd'hui
$statement = $pdo -> prepare("SELECT COUNT(*) AS nb_rendez_vous_confirmes
FROM rendez_vous
WHERE DATE(date_heure) = CURDATE() AND statut = 'confirmé'");
$statement -> execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
$nb_rendez_vous_confirmes = $result['nb_rendez_vous_confirmes'];



// tableau des rendez-vous d auWjourd-hui
$statement = $pdo -> prepare("SELECT rendez_vous.date_heure , rendez_vous.motif , rendez_vous.statut , patients.nom , patients.prenom , patients.telephone , prestations.description 
FROM rendez_vous
JOIN patients on patients.id_patient = rendez_vous.id_patient
JOIN prestations on prestations.id_prestation = rendez_vous.id_prestation 
WHERE DATE(date_heure) = CURDATE()");
$statement -> execute();
$rendez_vous_results = $statement -> fetchAll(PDO::FETCH_ASSOC);
