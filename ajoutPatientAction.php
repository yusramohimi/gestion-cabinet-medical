<?php
session_start();
require 'database.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['telephone']) || empty($_POST['email']) || empty($_POST['adresse']) || empty($_POST['historique_medical']) || empty($_POST['date_naissance']) ) {
        echo '<script>alert("Veuillez remplir tous les champs.")</script>';
    }else{
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date_naissance = $_POST["date_naissance"];
        $adresse = $_POST["adresse"];
        $telephone = $_POST["telephone"];
        $email = $_POST["email"];
        $historique_medical = $_POST['historique_medical'];
    
        $statement = $pdo -> prepare("INSERT INTO patients (nom,prenom,date_naissance,adresse,telephone,email,historique_medical) VALUES
         (:nom, :prenom, :date_naissance, :adresse, :telephone, :email, :historique_medical)");
        $statement -> execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':date_naissance' => $date_naissance,
            ':adresse' => $adresse,
            ':telephone' => $telephone,
            ':email' => $email,
            ':historique_medical' => $historique_medical
            
        ]);
        header("Location: listePatients.php");
        exit;
    }
    
}