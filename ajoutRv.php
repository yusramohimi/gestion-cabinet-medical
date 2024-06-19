<?php
ob_start();
require 'menu.php';
require 'listeDeroulante.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_patient = $_POST['id_patient'];
    $date_heure = $_POST['date_heure'];
    $motif = $_POST['motif'];
    $statut = $_POST['statut'];
    $id_prestation = $_POST['id_prestation'];

    $statement = $pdo->prepare("INSERT INTO rendez_vous (id_patient, date_heure, motif, statut, id_prestation)
        VALUES (:id_patient, :date_heure, :motif, :statut, :id_prestation)");
    $statement->execute([
        ':id_patient' => $id_patient,
        ':date_heure' => $date_heure,
        ':motif' => $motif,
        ':statut' => $statut,
        ':id_prestation' => $id_prestation
    ]);

    header("Location: listerendezVous.php");
    exit;
}
ob_end_flush(); 
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200">
    <div class='flex items-center justify-center bg-gray-0'>
        <div class='max-w-md mx-auto space-y-6'>
            <!-- Component starts here -->
            <h2 class="flex flex-row flex-nowrap items-center my-8">
                <span class="flex-none block mx-4 px-4 py-2.5 text-xl leading-none font-medium uppercase bg-black text-white">
                    Ajouter un Rendez-vous
                </span>
            </h2>
        </div>
    </div>
    <style>
        body {background:white !important;}
    </style>
    <form action="" method="POST">
        <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl mt-7">
            <div>
                <label for="id_patient" class="mb-2 block text-base font-medium text-[#07074D]">Patient:</label>
                <select id="id_patient" name="id_patient" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                    <option value="" selected disabled>Selectionner le patient</option>
                    <?php foreach ($patients as $patient): ?>
                        <option value="<?php echo $patient['id_patient']; ?>">
                            <?php echo $patient['nom'] . ' ' . $patient['prenom']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="date_heure" class="mb-2 block text-base font-medium text-[#07074D]">Date et Heure:</label>
                <input type="datetime-local" name="date_heure" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
            <div>
                <label for="motif" class="mb-2 block text-base font-medium text-[#07074D]">Motif:</label>
                <input type="text" name="motif" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" placeholder="Entrer le motif du rendez-vous"/>
            </div>
            <div>
                <label for="adresse" class="mb-2 block text-base font-medium text-[#07074D]">Statut:</label>
                <select id="statut" name="statut" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                    <option value="" selected disabled>Selectionner le statut du rendez-vous</option>
                    <option value="En attente">En attente</option>
                    <option value="Confirmé">Confirmé</option>
                    <option value="Annulé">Annulé</option>
                </select>
            </div>
            <div>
                <label for="telephone" class="mb-2 block text-base font-medium text-[#07074D]">Préstation:</label>
                <select id="id_prestation" name="id_prestation" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                    <option value="" selected disabled>Selectionner le type de la préstation</option>
                    <?php foreach ($prestations as $prestation): ?>
                        <option value="<?php echo $prestation['id_prestation']; ?>">
                            <?php echo $prestation['nom']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- icons -->
            <div class="icons flex text-gray-500 m-2">
                <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
            </div>
            <!-- buttons -->
            <div class="buttons flex">
                <input class="btn border border-blue-500 p-1 px-4 font-semibold cursor-pointer text-gray-100 ml-2 bg-blue-500 hover:bg-blue-600" type="submit" value="Ajouter le rendez-vous">
            </div>
        </div>
    </form>
</body>
</html>
