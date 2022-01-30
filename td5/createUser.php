<?php
spl_autoload_register(function ($className) {
     include ("lib/{$className}.class.php");
 });

try {
  require('lib/initDataLayer.php');
  require('lib/fonctions_parms.php');
  
   // à compléter
   $login = checkInformation("login");
   $password = checkInformation("password");
   $nom = checkInformation("nom");
   $prenom = checkInformation("prenom");
   $res = $data->createUser($login, $password, $nom, $prenom);
   if ($res){
     require('views/pageCreateOK.php');
     exit();
   } else {
     $erreurCreation = true;
     require('views/pageRegister.php');
     exit();
   }
 } catch (ParmsException $e) {
   echo $e;
 }

?>
