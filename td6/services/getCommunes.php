<?php
set_include_path('..'.PATH_SEPARATOR);
require_once('lib/common_service.php');
require_once('lib/initDataLayer.php');
require('lib/fonctions_parms.php');
try{
  
  $territoire =  checkUnsignedInt("territoire",NULL,false);
  $communes = $data->getCommunes($territoire);
  
  produceResult($communes);
  
}
catch (PDOException $e){
    produceError($e->getMessage());
}


?>
