<?php 
session_start();
require 'menu.php';
require 'database.php';
if (!isset($_SESSION['role']) && $_SESSION['role'] !== 'Gestionnaire'){
    header("Location: connexion.php");
    exit;
 }
    $statement = $pdo->prepare(" SELECT consultations.*, prestations.description, patients.nom 
    FROM consultations 
    JOIN prestations ON prestations.id_prestation = consultations.id_prestation
    JOIN patients ON patients.id_patient = consultations.id_patient
    ORDER BY date ASC ");
$statement->execute();
$consultations = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <!-- component -->
    <div class="min-h-screen bg-gray-50/50">

        <div class="p-4 xl:ml-80">
            <div class="mt-12">
                <button  class="flex gap-2 items-center  middle none center mr-4 rounded-lg bg-green-500 py-3 px-6 mb-5 font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:bg-green-600 hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" data-ripple-light="true">
                    <svg xmlns="http://www.w3.org/2000/svg" height="14" width="12.25" viewBox="0 0 448 512">
                        <path fill="#ffffff" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                    </svg>
                    <a href="">Ajouter une consultation</a>
                </button>
                <table class=" border-collapse w-full">
                    <thead>
                        <tr>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">ID patient</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Date Consultation</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Diagnostic</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Traitement</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Prestation</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Status</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($consultations as $consultation): ?>
                            <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <td class="w-full lg:w-auto p-3 text-blue-600 underline font-bold text-center border border-b block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">ID patient</span>
                                   <a href="detailsPatient.php?id=<?php echo $consultation['id_patient'] ?>"><?php echo $consultation['id_patient'] ?></a> 
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Date Consultation</span>
                                    <?php echo $consultation['date'] ?>
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Diagnostic</span>
                                    <?php echo $consultation['diagnostic'] ?>
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Traitement</span>
                                    <?php echo $consultation['traitement'] ?>
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Description prestation</span>
                                    <?php 
                                        $description = $consultation['description'];
                                        $bgColorClass = '';

                                        if ($description == 'Soin médical général') {
                                            $bgColorClass = 'bg-green-400';
                                        } elseif ($description == 'Contrôle de santé régulier') {
                                            $bgColorClass = 'bg-red-400';
                                        } elseif ($description == 'Consultation médicale standard') {
                                            $bgColorClass = 'bg-blue-400';
                                        }
                                    ?>
                                    <span class="rounded py-1 px-3 text-xs font-bold <?php echo $bgColorClass; ?>"><?php echo $description; ?></span>
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Statut</span>
                                    <?php echo $consultation['statut'] ?>
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                                    <a href="#" class="text-blue-400 hover:text-blue-600 underline">Edit</a>
                                    <a href="#" class="text-blue-400 hover:text-blue-600 underline pl-6">Remove</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                                        
            </div>
            
          
            
        </div>
        <!-- component -->
        

    </div>
</body>
</html>