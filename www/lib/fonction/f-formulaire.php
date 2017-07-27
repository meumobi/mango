<?php

function input($label,$nom,$type,$max,$valeur,$class,$class_div){

	if (!empty($valeur)) $valeur = stripslashes($valeur);
	if (!empty($class_div)) $class_div = 'class="'.$class_div.'"';
	if (!empty($class)) $class = 'class="'.$class.'"';
		
	$input  = '<div '.$class_div.'>';	
	
	if(!empty($label) != "") $input .= '<label>'.$label.'</label>';
	
	$input .= '<input type="'.$type.'" name="'.$nom.'" id="'.$nom.'" value="'.$valeur.'" maxlength="'.$max.'" size="'.$taille.'" '.$class.' />';
	$input .= '</div>';
	
	return $input;
}

function textarea($label,$nom,$valeur,$row,$class){
	
	if (!empty($valeur)) $valeur = stripslashes($valeur);
	if (!empty($class)) $class = 'class="'.$class.'"';

	$textarea  = '<div>';
	$textarea .= '<label>'.$label.'</label>';
	$textarea .= '<textarea name="'.$nom.'" id='.$nom.'" rows="'.$row.'" cols="50" '.$class.'>'.$valeur.'</textarea>';
	$textarea .= '</div>';
	
	return $textarea;
	
}

function liste($label,$nom,$valeur,$optgroup1,$query,$optgroup2,$query2,$class,$class_div){
	
	if (!empty($class_div)) $class_div = 'class="'.$class_div.'"';
	if (!empty($class)) $class = 'class="'.$class.'"';

		
	$select  = '<div '.$class_div.'>';
	$select .= '<label>'.$label.'</label>';
	$select .= '<select name="'.$nom.'" id="'.$nom.'" '.$class.'>';
	$select .= '<option value="">Séléctionnez dans la liste</option>';
	
	if(!empty($optgroup1)) $select .= '<optgroup label="'.$optgroup1.'">';
	
	while($res = mysqli_fetch_array($query)){
	
		
		if($valeur == $res["id"]) $selected = 'selected="selected"';
		
		$select .= '<option value="'.$res["id"].'" '.$selected.'>'.$res[1].'</option>';
		$selected = "";
	}
	
	if(!empty($optgroup1)) $select .= '</optgroup>';
	
	
	if(!empty($optgroup2)){
	
		$select .= '<optgroup label="'.$optgroup2.'">';
		
		while($res2 = mysqli_fetch_array($query2)){
	
			if($valeur == $res2["id"]) $selected = "selected";
		
			$select .= '<option value="'.$res2["id"].'" '.$selected.'>'.$res2[1].'</option>';
			$selected = "";
		}
		
		$select .= '</optgroup>';
	
	}
	
	$select .= '</select>';
	$select .= '</div>'; 
	
	return $select;
}

function checkbox($label,$nom,$valeur,$value,$class,$class_div){

	if ($valeur == 1) $checked = 'checked';
	

	if (!empty($class_div)) $class_div = 'class="'.$class_div.'"';
	if (!empty($class)) $class = 'class="'.$class.'"';



	$checkbox  = '<div '.$class_div.'>';
	$checkbox .= '<input type="checkbox" name="'.$nom.'" value="'.$value.'" '.$checked.' '.$class.' />'.$label;
	$checkbox .= '</div>';
	
	return $checkbox;

}

function bouton($label,$nom,$type,$class){

	$bouton = '<input type="'.$type.'" name="'.$nom.'" id="'.$nom.'" value="'.$label.'" class="'.$class.'" />';
	
	return $bouton;
}


?>


