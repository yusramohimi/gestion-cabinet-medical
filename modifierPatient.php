
<?php 
ob_start();
require 'menu.php';
require 'database.php';

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $statement = $pdo -> prepare('SELECT * FROM patients WHERE id_patient = :id_patient');
    $statement -> execute([
        'id_patient' =>  $id
    ]);
    $patient = $statement ->fetch(PDO::FETCH_ASSOC);
}

if($_SERVER['REQUEST_METHOD'] ==  'POST'){
    $statement = $pdo -> prepare('UPDATE patients SET nom = :nom , prenom = :prenom , date_naissance = :date_naissance , adresse = :adresse , telephone = :telephone , email = :email , historique_medical = :historique_medical WHERE id_patient = :id_patient');
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $adresse = $_POST['adresse'];
    $id_patient = $_POST['id_patient'];
    $telephone = $_POST['telephone'];
    $historique_medical = $_POST['historique_medical'];
    $email = $_POST['email'];

    $statement -> execute([
        ':id_patient' => $id_patient,
        ":nom" => $nom,
        ':prenom' => $prenom,
        ':date_naissance' => $date_naissance,
        ':adresse' => $adresse,
        ':telephone' => $telephone , 
        ':email' => $email,
        ':historique_medical' => $historique_medical
    ]);
    header('Location: listePatients.php');
    ob_end_flush();
}
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
                    Ajouter un patient
                </span>
            </h2>
            
        </div>
    </div>
<style>
  body {background:white !important;}
</style>
  
    <form action="" method="POST">
        <input type="hidden" name="id_patient" value="<?php echo $patient['id_patient'] ?>" />
        <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl mt-7">
            <div>
                <label for="nom"  class="mb-2 block text-base font-medium text-[#07074D]" > Nom </label>
                <input type="text" name="nom" id="nom" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" placeholder="Entrer le nom du patient" value="<?php echo $patient['nom'] ?>"/>
            </div>
            <div>
                <label for="prenom"  class="mb-2 block text-base font-medium text-[#07074D]" > Prenom </label>
                <input type="text" name="prenom" id="prenom" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" placeholder="Entrez le prenom du patient" value="<?php echo $patient['prenom'] ?>"/>
            </div>
            <div>
                <label for="date_naissance"  class="mb-2 block text-base font-medium text-[#07074D]" > Date de naissance </label>
                <input type="date" name="date_naissance" id="date_naissance" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" value="<?php echo $patient['date_naissance'] ?>"/>
            </div>
            <div>
                <label for="adresse"  class="mb-2 block text-base font-medium text-[#07074D]" > Adresse </label>
                <input type="text" name="adresse" id="adresse" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" placeholder="Entrez l'adresse du patient" value="<?php echo $patient['adresse'] ?>"/>
            </div>
            <div>
                <label for="telephone"  class="mb-2 block text-base font-medium text-[#07074D]" > Téléphone </label>
                <input type="tel" name="telephone" id="telephone" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" placeholder="Entrer le numéro de téléphone du patient" value="<?php echo $patient['telephone'] ?>"/>
            </div>
            <div>
                <label for="email"  class="mb-2 block text-base font-medium text-[#07074D]" > Email </label>
                <input type="email" name="email" id="email" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" placeholder="Entrez l'Email du patient" value="<?php echo $patient['email'] ?>"/>
            </div>
            <div>
                <label for="historique_medical"  class="mb-2 block text-base font-medium text-[#07074D]" > Historique médical </label>
                <textarea name="historique_medical" placeholder="Historique médical du patient " class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" ><?php echo $patient['historique_medical'] ?></textarea>
               
            </div>
            
            <!-- icons -->
            <div class="icons flex text-gray-500 m-2">
            <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
            <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
            <div class="count ml-auto text-gray-400 text-xs font-semibold">0/300</div>
            </div>
            <!-- buttons -->
            <div class="buttons flex">
            <!-- <input type="reset" class="btn border border-gray-300 p-1 px-4 font-semibold cursor-pointer text-gray-500 ml-auto" value="Cancel"> -->
            <input  class="btn border border-blue-500 p-1 px-4 font-semibold cursor-pointer text-gray-100 ml-2 bg-blue-500 hover:bg-blue-600" type="submit" value="Enregistrer les modifications">
            <!-- <button class="btn border border-gray-300 p-1 px-4 font-semibold cursor-pointer text-gray-500 ml-auto" id="btn-connecter">Connect</button> -->
            </div>
        </div>
    </form>
    </script>
    </body>
</html>
