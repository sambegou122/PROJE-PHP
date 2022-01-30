<?php
  /*
    Utilise le contenu de $_SESSION (en particulier $_SESSION['ident'])
  */
  if ( ! isset($_SESSION['ident'])){  // si la page était protégée, on ne devrait même pas faire ce test
      require('views/pageErreur.php');
      exit();
  }
  $personne = $_SESSION['ident'];
  $avatarURL = "images/avatar_def.png";
  //$avatarURL = "getAvatar.php?login={$personne->login}";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta charset="UTF-8"/>
    <title>Page à accès contrôlé</title>
    <link rel="stylesheet" type="text/css" href="style_authent.css" />
  </head>
<body>
<header>
<h1>

<?php
echo "<img class=\"avatar\" src=\"$avatarURL\" />";
echo "{$personne->prenom} {$personne->nom}";
?>
</h1>
</header>
<div id="content">
  Cette page est un peu vide, non ?
</div>
<footer><a href="logout.php">Se déconnecter</a> <a href="formUpload.php">Changer d'avatar</a>
</footer>
</body>
</html>
