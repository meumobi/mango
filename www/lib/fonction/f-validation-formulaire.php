<?php 

function validationinput($formulaire,$nom_input,$operateur,$valeur_operateur,$message,$return){ 

	$validation  = 'if (document.'.$formulaire.'.'.$nom_input.'.value.length '.$operateur.' '.$valeur_operateur.')';
	$validation .= '{';
	$validation .= 'alert("'.$message.'");';
	$validation .= 'document.'.$formulaire.'.'.$nom_input.'.focus();';
	$validation .= 'return '.$return.';';
	$validation .= '}';
	
	return $validation;
}


function validationchecked($formulaire,$nom_input,$operateur,$valeur_operateur,$message,$return){ 

	$validation  = 'if (document.'.$formulaire.'.'.$nom_input.'.checked '.$operateur.' '.$valeur_operateur.')';
	$validation .= '{';
	$validation .= 'alert("'.$message.'");';
	$validation .= 'document.'.$formulaire.'.'.$nom_input.'.focus();';
	$validation .= 'return '.$return.';';
	$validation .= '}';
	
	return $validation;
}


?>