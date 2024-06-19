<?php
ob_start();
session_start();
require 'menuPatient.php';
require 'database.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Patient') {
    header("Location: connexion.php");
    exit;
}

if (!isset($_SESSION['id_patient'])) {
    header("Location: connexion.php");
    exit;
}

$id_patient = $_SESSION['id_patient'];
$statement = $pdo -> prepare('SELECT * FROM patients WHERE id_patient = :id_patient');
$statement -> execute([
    ':id_patient' => $id_patient
]);
$patient = $statement->fetch(PDO::FETCH_ASSOC);
if (!$patient) {
    echo "Erreur : Le patient avec l'ID $id_patient n'a pas été trouvé.";
    exit;
}
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://horizon-tailwind-react-git-tailwind-components-horizon-ui.vercel.app/static/css/main.ad49aa9b.css" />

    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <!-- component -->
    <div class="flex flex-col justify-center items-center h-[100vh]">
        <div class="relative flex flex-col items-center rounded-[20px] w-[700px] max-w-[95%] mx-auto bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none p-3"> 
            <div class="grid grid-cols-2 gap-4 px-2 w-full">
                <div class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                    <p class="text-sm text-gray-600">Nom</p>
                    <p class="text-base font-medium text-navy-700 dark:text-white">
                        <?php echo ($patient['nom']); ?> 
                    </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                    <p class="text-sm text-gray-600">Prénom</p>
                    <p class="text-base font-medium text-navy-700 dark:text-white">
                        <?php echo ($patient['prenom']); ?> 
                    </p>
                </div>

                <div class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                    <p class="text-sm text-gray-600">Date de naissance</p>
                    <p class="text-base font-medium text-navy-700 dark:text-white">
                        <?php echo ($patient['date_naissance']); ?> 
                    </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                    <p class="text-sm text-gray-600">Adresse</p>
                    <p class="text-base font-medium text-navy-700 dark:text-white">
                        <?php echo ($patient['adresse']); ?> 
                    </p>
                </div>

                <div class="flex flex-col items-start justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="text-base font-medium text-navy-700 dark:text-white">
                        <?php echo ($patient['email']); ?> 
                    </p>
                </div>

                <div class="flex flex-col justify-center rounded-2xl bg-white bg-clip-border px-3 py-4 shadow-3xl shadow-shadow-500 dark:!bg-navy-700 dark:shadow-none">
                    <p class="text-sm text-gray-600">Téléphone</p>
                    <p class="text-base font-medium text-navy-700 dark:text-white">
                        <?php echo ($patient['telephone']); ?> 
                    </p>
                </div>
            </div>
            <!-- Bouton Modifier -->
            <div class="mt-4">
                <a href="modifierProfilePatient.php" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Modifier
                </a>
            </div>
        </div>  
    </div>
</body>
</html>
