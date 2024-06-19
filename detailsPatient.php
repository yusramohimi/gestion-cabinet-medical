<?php
session_start();
require 'menu.php';
require 'database.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Gestionnaire') {
    header("Location: connexion.php");
    exit;
}
$buttonText = '';
$buttonLink = '';

if (isset($_SERVER['HTTP_REFERER'])) {
    $previousPage = basename($_SERVER['HTTP_REFERER']); 

    if ($previousPage == 'consultation.php') {
        $buttonText = 'Liste des Consultations';
        $buttonLink = 'consultation.php';
    } elseif ($previousPage == 'listerendezVous.php') {
        $buttonText = 'Liste des rendez-vous';
        $buttonLink = 'listerendezVous.php';
    }
}

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $statement = $pdo->prepare('SELECT * FROM patients WHERE id_patient = :id_patient');
    $statement->execute([
        ':id_patient' => $id
    ]);
    $patient= $statement->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Details du patient</title>
</head>
<body>
    <!-- component -->
    <div class="min-h-screen bg-gray-50/50">
       
        <div class="p-4 xl:ml-80">
            <div class="mt-12">
                <button  class="flex gap-2 items-center  middle none center mr-4 rounded-lg bg-blue-500 py-3 px-6 mb-5 font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:bg-blue-600 hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" data-ripple-light="true">
                <svg xmlns="http://www.w3.org/2000/svg" height="14" width="14" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M459.5 440.6c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29V96c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4L288 214.3V256v41.7L459.5 440.6zM256 352V256 128 96c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4l-192 160C4.2 237.5 0 246.5 0 256s4.2 18.5 11.5 24.6l192 160c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29V352z"/></svg>
                    <a href="<?php echo $buttonLink; ?>"><?php echo $buttonText; ?></a>
                </button>

                <table class=" border-collapse w-full">
                    <thead>
                        <tr>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Nom patient</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Prenom patient</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Date de naissance</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Adresse</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Téléphone</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Email</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Historique médical</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Nom patient</span>
                                   <?php echo $patient['nom'] ?>
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Prenom patient</span>
                                    <?php echo $patient['prenom'] ?>
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Date de naissance</span>
                                    <?php echo $patient['date_naissance'] ?>
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">adresse</span>
                                    <?php echo $patient['adresse'] ?>
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Téléphone</span>
                                    <?php echo $patient['telephone'] ?>
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">email</span>
                                    <?php echo $patient['email'] ?>
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Historique medical</span>
                                    <?php echo $patient['historique_medical'] ?>
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                                    <a href="#" class="text-blue-400 hover:text-blue-600 underline">Edit</a>
                                    <a href="#" class="text-blue-400 hover:text-blue-600 underline pl-6">Remove</a>
                                </td>
                            </tr>
                        
                    </tbody>
                </table>
                
                                        
            </div>
            
          
            
        </div>
        <!-- component -->
        

    </div>
</body>
</html>