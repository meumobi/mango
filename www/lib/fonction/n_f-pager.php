<?php

function pager($exist,$par_page,$p,$param1,$valeur1,$param2,$valeur2,$param3,$valeur3,$param4,$valeur4,$param5,$valeur5){ 

	//conditions
	if (!empty($valeur1)) $param  = '&'.$param1.'='.$valeur1;
	if (!empty($valeur2)) $param .= '&'.$param2.'='.$valeur2;
	if (!empty($valeur3)) $param .= '&'.$param3.'='.$valeur3;
	if (!empty($valeur4)) $param .= '&'.$param4.'='.$valeur4;
	if (!empty($valeur5)) $param .= '&'.$param5.'='.$valeur5;


	$pager = '<nav class="line txtcenter w100"><ul class="unstyled inbl phone100">';
	
	
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
			$pager .= '<li class="bgRed left phoneLeft paPager  mr1"><a class="fontWhite" href="'.basename($PHP_SELF).'?p='.($p-1).$param.'">Précédent</a></li>';
		}
	
		for ($i = $debut ; $i <= $fin ; $i++){
		
			if ($i == $p){
				$pager .= '<li class="phone-hidden bgBlack  inbl paPager left mr1"><strong class="fontWhite">'.$i.'</strong></span>';
			}elseif ($i != 0){
				$pager .= '<li class="phone-hidden bgRed  inbl paPager left mr1"><a class="fontWhite" href="'.basename($PHP_SELF).'?p='.$i.$param.'">'.$i.'</a></li>';
			}
		}
		
		if ($p < $nbr_pages_total){
			$pager .= '<li class="bgRed left phoneLeft paPager"><a class="fontWhite" href="'.basename($PHP_SELF).'?p='.($p+1).$param.'">Suivant</a></li>';
		}
	}
	
	
	$pager .= "</ul></nav>";
	
	return $pager;

} 



function pager_rewriting($exist,$par_page,$p,$nom_fichier,$id_content,$commentaire,$variable){ 

	if((!empty($variable)) OR ($variable == "0")){
		$variable = '-'.$variable;
	}	

	
	$pager = '<nav class="line txtcenter w100"><ul class="unstyled inbl phone100">';
	
	
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
			$pager .= '<li class="mod  bgRed left phoneLeft paPager mr1"><a class="fontWhite" href="'.$nom_fichier.'-'.$untireenplus.$id_content.$variable.'-'.($p-1).'.html'.$commentaire.'">Précédent</a></li>';
		}
	
		for ($i = $debut ; $i <= $fin ; $i++){
		
			if ($i == $p){
				$pager .= '<li class="phone-hidden mod bgBlack  inbl paPager left mr1"><strong class="fontWhite">'.$i.'</strong></li>';
			}elseif ($i != 0){
				$pager .= '<li class="phone-hidden mod bgRed  inbl paPager left mr1"><a class="fontWhite" href="'.$nom_fichier.'-'.$untireenplus.$id_content.$variable.'-'.$i.'.html'.$commentaire.'">'.$i.'</a></li>';
			}
		}
		
		if ($p < $nbr_pages_total){
			$pager .= '<li class="mod inbl bgRed inbl left phoneLeft paPager"><a class="fontWhite" href="'.$nom_fichier.'-'.$untireenplus.$id_content.$variable.'-'.($p+1).'.html'.$commentaire.'">Suivant</a></li>';
		}
	}
	
	$pager .= "</ul></nav>";
	
	return $pager;

} 
?>