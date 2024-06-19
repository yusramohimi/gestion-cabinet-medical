<?php
session_start();
$loginError = '';
if(isset($_SESSION['loginError'])){
    $loginError = $_SESSION['loginError'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<style>
  .login{
  /* background-image: url('images/background.png'); */
  background-repeat: no-repeat;
  background-size: cover;
  background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),
  url(images/2.png);
  background-position: center ;
  
}
</style>
<body class="bg-gray-900">
<!-- component -->
<!-- This is an example component -->
<div class="h-screen font-sans login bg-cover">
<div class="container mx-auto h-full flex flex-1 justify-center items-center">
    <div class="w-full max-w-lg">
      <div class="leading-loose">
        <form class="max-w-md m-4 p-10 bg-white bg-opacity-25 rounded shadow-xl" method="POST" action="connexionAction.php">
            <p class="text-white font-medium text-center text-lg font-bold">LOGIN</p>
              <div class="">
                <label class="block text-sm text-white" for="email">E-mail</label>
                <input class="w-full px-5 py-1 text-gray-700 bg-gray-300 rounded focus:outline-none focus:bg-white" type="email" id="email" name="email" placeholder="Entrer votre E-mail" aria-label="email" required>
              </div>
              <div class="mt-2">
                <label class="block  text-sm text-white">Mot de passe</label>
                 <input class="w-full px-5 py-1 text-gray-700 bg-gray-300 rounded focus:outline-none focus:bg-white"
                  type="password" id="password" name="password" placeholder="Entrer votre mot de passe" arial-label="password" required>
              </div>
              <span class="text-red-500 font-bold"><?= $loginError ;?></span>
              <div class="mt-4 items-center flex justify-center">
                <button class="px-6 py-1 text-white font-light tracking-wider bg-gray-900 hover:bg-gray-800 rounded" type="submit">Se connecter</button>
              </div>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>
