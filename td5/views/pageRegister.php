<?php
/*
  Si la variable globale $erreurCreation est définie, un message d'erreur est affiché
  dans un paragraphe de classe 'message'
*/
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta charset="UTF-8"/>
    <title>Création d'utilisateur</title>
</head>
<body>
<h2>Demande de création d'un utilisateur</h2>

<?php
 if (isset($erreurCreation) && $erreurCreation)
   echo "<p class='message'>Le compte n'a pas pu être créé</p>";
?>

<form method="POST" action="createUser.php">
 <fieldset>
   <label for="nom">Nom :</label>
   <input type="text" name="nom" id="nom" required="required" autofocus/>
   <label for="prenom">Prénom :</label>
   <input type="text" name="prenom" id="prenom" required="required" autofocus/>
   <label for="login">Login :</label>
   <input type="text" name="login" id="login" required="required" autofocus/>
  <label for="password">Mot de passe :</label>
  <input type="password" name="password" id="password" required="required" />
  <button type="submit" name="valid" value="bouton_valid">OK</button>
 </fieldset>
</form>
</body>
</html>
