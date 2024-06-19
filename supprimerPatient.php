<?php 
require 'database.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $statement = $pdo->prepare("DELETE FROM patients WHERE id_patient = :id_patient");
    $statement->execute([
    ':id_patient' => $id
]);

header('Location: listePatients.php');
exit;
}