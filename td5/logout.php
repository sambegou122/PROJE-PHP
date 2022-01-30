<?php
spl_autoload_register(function ($className) {
     include ("lib/{$className}.class.php");
 });;

require('etc/dsn_filename.php');
$data = new DataLayer(DSN_FILENAME);

require_once('lib/watchdog.php');
unset($_SESSION['ident']);
session_destroy();
require('views/pageLogout.php');
?>
