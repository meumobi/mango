<?php

function pager($exist,$par_page,$p,$param1,$valeur1,$param2,$valeur2,$param3,$valeur3,$param4,$valeur4,$param5,$valeur5){ 

	//conditions
	if (!empty($valeur1)) $param  = '&'.$param1.'='.$valeur1;
	if (!empty($valeur2)) $param .= '&'.$param2.'='.$valeur2;
	if (!empty($valeur3)) $param .= '&'.$param3.'='.$valeur3;
	if (!empty($valeur4)) $param .= '&'.$param4.'='.$valeur4;
	if (!empty($valeur5)) $param .= '&'.$param5.'='.$valeur5;


	$pager = '<div id="pager" class="clearB">';
	
	
	if (($exist > $par_page)){ 
	
		$nbr_pages_total = ceil($exist / $par_page);
		$split_nav_archive = 10;
	
		if (($p - ($split_nav_archive/2)) > 0){
			$debut = $p - ($split_nav_archive / 2);
		}else{
			$debut = 1;
		}
	
		if (($p + ($split_nav_archive/2)) > $nbr_pages_total){
			$fin = $nbr_pages_total;
		}else{
			$fin = $p + ($split_nav_archive / 2);
		}
	
		if ($p > 1){
			$pager .= '<span class="bloc_arrondie"><a href="'.basename($PHP_SELF).'?p='.($p-1).$param.'">Précédent</a></span>';
		}
	
		for ($i = $debut ; $i <= $fin ; $i++){
		
			if ($i == $p){
				$pager .= '<span class="bloc_arrondie page">'.$i.'</span>';
			}elseif ($i != 0){
				$pager .= '<span class="bloc_arrondie"><a href="'.basename($PHP_SELF).'?p='.$i.$param.'">'.$i.'</a></span>';
			}
		}
		
		if ($p < $nbr_pages_total){
			$pager .= '<span class="bloc_arrondie"><a href="'.basename($PHP_SELF).'?p='.($p+1).$param.'">Suivant</a></span>';
		}
	}
	
	
	$pager .= "</div>";
	
	return $pager;

} 



function pager_rewriting($exist,$par_page,$p,$nom_fichier,$id_content,$commentaire,$variable){ 

	if((!empty($variable)) OR ($variable == "0")){
		$variable = '-'.$variable;
	}	

	
	$pager = '<div id="pager" class="clearB">';
	
	
	if (($exist > $par_page)){ 
	
		$nbr_pages_total = ceil($exist / $par_page);
		$split_nav_archive = 10;
		
		
		if (($p - ($split_nav_archive/2)) > 0){
			$debut = $p - ($split_nav_archive / 2);
		}else{
			$debut = 1;
		}
	
		if (($p + ($split_nav_archive/2)) > $nbr_pages_total){
			$fin = $nbr_pages_total;
		}else{
			$fin = $p + ($split_nav_archive / 2);
		}
	
		if ($p > 1){
			$pager .= '<span class="bloc_arrondie"><a href="'.$nom_fichier.'-'.$untireenplus.$id_content.$variable.'-'.($p-1).'.html'.$commentaire.'">Précédent</a></span>';
		}
	
		for ($i = $debut ; $i <= $fin ; $i++){
		
			if ($i == $p){
				$pager .= '<span class="bloc_arrondie page">'.$i.'</span>';
			}elseif ($i != 0){
				$pager .= '<span class="bloc_arrondie"><a href="'.$nom_fichier.'-'.$untireenplus.$id_content.$variable.'-'.$i.'.html'.$commentaire.'">'.$i.'</a></span>';
			}
		}
		
		if ($p < $nbr_pages_total){
			$pager .= '<span class="bloc_arrondie"><a href="'.$nom_fichier.'-'.$untireenplus.$id_content.$variable.'-'.($p+1).'.html'.$commentaire.'">Suivant</a></span>';
		}
	}
	
	$pager .= "</div>";
	
	return $pager;

} 
?>