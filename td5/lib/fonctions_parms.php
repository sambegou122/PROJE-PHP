<?php


 /**
  *  prend en compte le paramètre $information passé en mode Post
  *   qui doit représenter une chaîne
  *  @return : valeur retenue, convertie en string.
  *   - si le paramètre est vide, renvoie  $defaultValue
  *   - si le paramètre est incorrect, déclenche une exception ParmsException
  *
  */
 function checkInformation(string $information, ?string $defaultValue=NULL, bool $mandatory=true) : ?string {
	if($_POST[$information] == ""){
		if($defaultValue==NULL){
			if($mandatory){
				throw new ParmsException("null default value") ;
            }
            return NULL;
        }
        return $defaultValue;
    }
	else{
        return  $_POST[$information];
    }
  }
     
 ?>
