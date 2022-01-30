<?php


 /**
  *  prend en compte le paramètre $name passé en mode GET
  *   qui doit représenter un entier sans signe
  *  @return : valeur retenue, convertie en int.
  *   - si le paramètre est absent ou vide, renvoie  $defaultValue
  *   - si le paramètre est incorrect, déclenche une exception ParmsException
  *
  */
 function checkUnsignedInt(string $name, ?int $defaultValue=NULL, bool $mandatory=true) : ?int {
	if($_GET[$name] == "" || isset($_GET[$name]) == FALSE){
		if($defaultValue==NULL){
			if($mandatory){
				throw new ParmsException("null default value") ;
            }
            return NULL;
        }
        return $defaultValue;
    }
	else{
		if (ctype_digit($_GET[$name])==FALSE){
        	throw new ParmsException("not a digit");
        }
     	else return (int) $_GET[$name];
    }
  }
     
 ?>
