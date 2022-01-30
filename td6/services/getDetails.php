<?php
set_include_path('..'.PATH_SEPARATOR);
require_once('lib/common_service.php');
require_once('lib/initDataLayer.php');
require('lib/fonctions_parms.php');
try{
  try{
  $insee =  checkUnsignedInt("insee");
  }
  catch(ParmsException $e){
      throw new PDOException($e->getMessage());
  }
  $details = $data->getDetails($insee);
  if(is_null($details)){
    throw new PDOException("La ville n'est pas dans les territoires");
  }
  produceResult($details);
  
}
catch (PDOException $e){
    produceError($e->getMessage());
}


?>