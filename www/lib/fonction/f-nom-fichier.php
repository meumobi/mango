<?php

function prepare_url($texte){
	$texte = strtolower(epure($texte));
	$pattern = explode(" ",$texte);
	
	for ($i = 0 ; $i < count($pattern) ; $i++){
		$motif = filtre_url($pattern[$i]);
		if ($motif != "")
			$key .= $motif."-";
	}
	
	$key = substr($key,0,(strlen($key)-1));
	return trim($key);
}

function filtre_url($mot){
	$mot=trim($mot);
	$taille = strlen($mot);
	$derniere_lettre = substr($mot, $taille-1, 1);
	$mot = ereg_replace("c'","",$mot);
	$mot = ereg_replace("d'","",$mot);
	$mot = ereg_replace("l'","",$mot);
	$mot = ereg_replace("m'","",$mot);
	$mot = ereg_replace("n'","",$mot);
	$mot = ereg_replace("s'","",$mot);
	$mot = ereg_replace("t'","",$mot);
	$mot = str_replace("'","",$mot);
		
	$taille = strlen($mot);	
	
	if ($taille <=1 )
		return "";
	elseif ($taille <= 6){
		if (banni_terme_impropre($mot) != "")
			return $mot;
		else
			return "";
	}	
	else
		return $mot;
}

function prepare_keywords($texte){
	$texte = strtolower(epure($texte));
	$pattern = explode(" ",$texte);
	
	for ($i = 0 ; $i < count($pattern) ; $i++){
		$motif = filtre_keyword($pattern[$i]);
		if ($motif != "")
			$key .= $motif." ";
	}
	return trim($key);
}

function epure($expression){
	$expression = trim(stripslashes($expression));
	$expression = eregi_replace(""," ",$expression);
	$expression = eregi_replace("\+"," ",$expression);
	$expression = str_replace(")"," ",$expression);	
	$expression = str_replace("("," ",$expression);
	$expression = eregi_replace(""," ",$expression);
	$expression = eregi_replace("«"," ",$expression);	
	$expression = eregi_replace("»"," ",$expression);
	$expression = str_replace("."," ",$expression);	
	$expression = str_replace(","," ",$expression);	
	$expression = str_replace(";"," ",$expression);
	$expression = str_replace(":"," ",$expression);	
	$expression = str_replace("!"," ",$expression);	
	$expression = str_replace("&"," ",$expression);		
	$expression = eregi_replace(" [[:alnum:]]{2} "," ",$expression);
	$expression = eregi_replace("^[[:alnum:]]{2} ","",$expression);
	$expression = eregi_replace(" [[:alnum:]]{1} "," ",$expression);
	$expression = eregi_replace("^[[:alnum:]]{1} ","",$expression);
	$expression = eregi_replace("[[:punct:]]"," ",$expression);
	$expression = ereg_replace("[[:space:]]{2,}"," ",$expression);
	return trim($expression);
}

		
function filtre_keyword($mot){
	$mot=trim($mot);
	$taille = strlen($mot);
	$derniere_lettre = substr($mot, $taille-1, 1);
	$mot = ereg_replace("c'","",$mot);
	$mot = ereg_replace("d'","",$mot);
	$mot = ereg_replace("l'","",$mot);
	$mot = ereg_replace("m'","",$mot);
	$mot = ereg_replace("n'","",$mot);
	$mot = ereg_replace("s'","",$mot);
	$mot = ereg_replace("t'","",$mot);
	$mot = str_replace("'","",$mot);
	
	$taille = strlen($mot);
	if (($derniere_lettre == "s") || ($derniere_lettre == "x"))
		$mot2 = " ".substr($mot,0,$taille -1);
	
	$taille = strlen($mot);	
	
	if ($taille <=1 )
		return "";
	elseif ($taille <= 6){
		if (banni_terme_impropre($mot) != "")
			return $mot.$mot2;
		else
			return "";
	}	
	else
		return $mot.$mot2;
}

function banni_terme_impropre($mot){
	if (($mot == "de")
		|| ($mot == "des")
		|| ($mot == "ces")
		|| ($mot == "ses")
		|| ($mot == "dans")
		|| ($mot == "tous")
		|| ($mot == "tout")
		|| ($mot == "toute")
		|| ($mot == "toutes")
		|| ($mot == "pour")
		|| ($mot == "mais")
		|| ($mot == "t")
		|| ($mot == "avec")
		|| ($mot == "que")
		|| ($mot == "qui")
		|| ($mot == "quoi")
		|| ($mot == "il")
		|| ($mot == "ils")
		|| ($mot == "elle")
		|| ($mot == "elles")
		|| ($mot == "dont")
		|| ($mot == "donc")
		|| ($mot == "sont")
		|| ($mot == "trs")
		|| ($mot == "peu")
		|| ($mot == "peut")
		|| ($mot == "peux")
		|| ($mot == "nous")
		|| ($mot == "nos")
		|| ($mot == "vos")
		|| ($mot == "leurs")
		|| ($mot == "font")
		|| ($mot == "leur")
		|| ($mot == "qu")
		|| ($mot == "ou")
		|| ($mot == "les")
		|| ($mot == "mes")
		|| ($mot == "par")
		|| ($mot == "une")
		|| ($mot == "le")
		|| ($mot == "me")
		|| ($mot == "ne")
		|| ($mot == "se")
		|| ($mot == "ce")
		|| ($mot == "te")
		|| ($mot == "et")
		|| ($mot == "je")
		|| ($mot == "ni")
		|| ($mot == "si")
		|| ($mot == "ci")		
		|| ($mot == "sa")
		|| ($mot == "ma")
		|| ($mot == "la")	
		|| ($mot == "va")	
		|| ($mot == "du")
		|| ($mot == "dan")
		|| ($mot == "au")
		|| ($mot == "aux")	
		|| ($mot == "sur")	
		|| ($mot == "aprs")
		|| ($mot == "com")	
		|| ($mot == "un")
		|| ($mot == "curl"))
			return "";
		else
			return $mot;

}


function nom_fichier_define($terme){
	$nfic = strtolower($terme);
	$nfic = ereg_replace("\(","",$nfic);
	$nfic = ereg_replace("\)","",$nfic);
	$nfic = ereg_replace("\[","-",$nfic);
	$nfic = ereg_replace("\]","-",$nfic);
	$nfic = ereg_replace("}","-",$nfic);
	$nfic = ereg_replace(" ","-",$nfic);
	$nfic = ereg_replace("à","a",$nfic);
	$nfic = ereg_replace("ä","a",$nfic);
	$nfic = ereg_replace("â","a",$nfic);
	$nfic = ereg_replace("é","e",$nfic);
	$nfic = ereg_replace("è","e",$nfic);
	$nfic = ereg_replace("ê","e",$nfic);
	$nfic = ereg_replace("ë","e",$nfic);
	$nfic = ereg_replace("ô","o",$nfic);
	$nfic = ereg_replace("ö","o",$nfic);
	$nfic = ereg_replace("ï","i",$nfic);
	$nfic = ereg_replace("î","i",$nfic);
	$nfic = ereg_replace("ù","u",$nfic);
	$nfic = ereg_replace("ü","u",$nfic);
	$nfic = ereg_replace("û","u",$nfic);
	$nfic = ereg_replace("À","a",$nfic);
	$nfic = ereg_replace("Â","a",$nfic);
	$nfic = ereg_replace("É","e",$nfic);
	$nfic = ereg_replace("È","e",$nfic);
	$nfic = ereg_replace("Ê","e",$nfic);
	$nfic = ereg_replace("Ë","e",$nfic);
	$nfic = ereg_replace("Ô","o",$nfic);
	$nfic = ereg_replace("Ö","o",$nfic);
	$nfic = ereg_replace("Ï","i",$nfic);
	$nfic = ereg_replace("Î","i",$nfic);
	$nfic = ereg_replace("ù","u",$nfic);
	$nfic = ereg_replace("Ü","u",$nfic);
	$nfic = ereg_replace("Û","u",$nfic);
	$nfic = ereg_replace(":","",$nfic);
	$nfic = ereg_replace(",","",$nfic);
	$nfic = ereg_replace(";","",$nfic);
	$nfic = ereg_replace("\?","",$nfic);
	$nfic = ereg_replace("\.","",$nfic);
	$nfic = ereg_replace("µ","m",$nfic);
	$nfic = ereg_replace("°","-",$nfic);
	$nfic = ereg_replace("\/","-",$nfic);
	$nfic = ereg_replace("'","-",$nfic);
	$nfic = ereg_replace('"',"",$nfic);
	$nfic = ereg_replace("","-",$nfic);
	$nfic = ereg_replace("","",$nfic);
	$nfic = ereg_replace("ç","c",$nfic);
	$nfic = ereg_replace("Ç","C",$nfic);
	$nfic = ereg_replace("’","",$nfic);
	$nfic = ereg_replace("–","-",$nfic);
	$nfic = ereg_replace(":","",$nfic);
	$nfic = ereg_replace("¼","",$nfic);
	

	return stripslashes(substr($nfic,0,240));
	
	
	
	
}
?>