<?php
/*
  Si $_SESSION['echec'] est définie, un message d'erreur est affiché
  dans un paragraphe de classe 'message'
*/
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta charset="UTF-8"/>
    <title>Authentifiez-vous</title>

    <script src="js/fetchUtils.js"></script>
    <script src="js/loginService.js"></script>


</head>
<body>
<?php
 if (isset($_SESSION['echec']))
   echo "<p class='message'>Les login et mot de passe précédemment fournis étaient incorrects</p>";
?>
<h2>Authentifiez-vous</h2>

<form method="POST" action="" name="form_login">
 <fieldset>
  <label for="login">Login :</label>
  <input type="text" name="login" id="login" required="required" autofocus/>
  <label for="password">Mot de passe :</label>
  <input type="password" name="password" id="password" required="required" />
  <button type="submit" name="valid">OK</button>
 </fieldset>
</form>
<div id="message"></div>
</body>
</html>

<?php
?>
