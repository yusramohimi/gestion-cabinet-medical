<?php
session_start();
require('database.php');

if (empty($_POST['email']) || empty($_POST['password'])) {
    $_SESSION['loginError'] = "Les données d'authentification sont obligatoires";
    header("Location: connexion.php");
    exit;
}


$statement = $pdo->prepare("SELECT id_role, role_name FROM roles WHERE role_name IN ('Gestionnaire', 'Patient')");
$statement->execute();
$roles = $statement->fetchAll(PDO::FETCH_ASSOC);

$roleMap = [];
foreach ($roles as $role) {
    $roleMap[$role['role_name']] = $role['id_role'];
}

$roleGestionnaireId = $roleMap['Gestionnaire'];
$rolePatientId = $roleMap['Patient'];

$statement = $pdo->prepare("SELECT users.*, roles.role_name, patients.id_patient 
    FROM users
    JOIN roles ON roles.id_role = users.id_role
    LEFT JOIN patients ON patients.id_user = users.id
    WHERE users.email = :email 
    AND users.password = :password
");
$statement->execute([
    ':email' => $_POST['email'],
    ':password' => $_POST['password']
]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $_SESSION['role'] = $user['role_name'];
    if ($user['role_name'] == 'Patient') {
        $_SESSION['id_patient'] = $user['id_patient'];
    }
    $_SESSION['nom'] = $user['nom'];
    $_SESSION['prenom'] = $user['prenom'];
    unset($_SESSION["loginError"]);

    if ($_SESSION['role'] == 'Gestionnaire') {
        header('Location: dashboard.php');
        exit;
    } elseif ($_SESSION['role'] == 'Patient') {
        header('Location: dashboardPatient.php');
        exit;
    }
    exit;
} else {
    $_SESSION['loginError'] = "Les données d'authentification sont incorrectes";
    header('Location: connexion.php');
    exit;
}
?>
