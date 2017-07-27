<?php

//récupère ip
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

//function recupere nom Tag
//function recupere nom Tag
function recupereNomTag($id,$mysql_link){
		
	$tag ="";
	
	$req_tag = "SELECT nom FROM m_tag WHERE id=".$id;
	$query_tag = mysqli_query($mysql_link,$req_tag);
	$res_tag = mysqli_fetch_array($query_tag);
	
	$tag = $res_tag["nom"];
	
	return $tag;
	
}


//fonction affiche Tag
function afficheTag($id_tag,$mysql_link){
	
	//si on a des tags dans une news
	if(!empty($id_tag)){
		
		$liste_tag = '';

		$tag = explode("-",$id_tag);
		$nbrtag = count($tag);
		
		for($i=0;($i+1)<=$nbrtag;$i++){
			
			$req_tag = "SELECT id, id_rubrique, nom, nom_fichier FROM m_tag WHERE id=".$tag[$i];
			$query_tag = mysqli_query($mysql_link,$req_tag);
			$res_tag = mysqli_fetch_array($query_tag);
					
			$liste_tag .= '<a class="small tag" href="/'.urlFichier($tag[$i],$res_tag['id_rubrique'],$mysql_link).'" title="'.$res_tag["nom"].'">'.$res_tag["nom"].'</a>';
		

		}
	}

	
	return $liste_tag;
}


//fonction affiche Tag Facebook
function afficheTagFacebook($id_tag,$mysql_link){
	
	//si on a des tags dans une news
	if(!empty($id_tag)){
		
		$tag = explode("-",$id_tag);
		$nbrtag = count($tag);
		
		for($i=0;($i+1)<=$nbrtag;$i++){
			
			$req_tag = "SELECT nom FROM m_tag WHERE id=".$tag[$i];
			$query_tag = mysqli_query($mysql_link,$req_tag);
			$res_tag = mysqli_fetch_array($query_tag);
					
			$liste_tag .= '#'.$res_tag["nom"];
		
			if($nbrtag != ($i+1)){
				$liste_tag .= " ";
			}
		}
	}

	
	return $liste_tag;
}




// Recupere le dernier id
function last_id($nom_table,$mysql_link){

	

	$req = "SELECT id FROM ".$nom_table." ORDER BY id DESC";
	$query = mysqli_query($mysql_link,$req);	
	$res = mysqli_fetch_array($query);	
	
	$last_id = ($res['id']+1);
	
	return $last_id;
}


// Recupere la date corrante 
function dateformat($date,$format_envoye,$format_retourne){

	if(!empty($date)){
	
		$date = ereg_replace("/", "-", $date);
		$date = explode("-",$date);
		
		if($format_envoye == "en" AND $format_retourne == "fr") $date_publication = $date[2].'-'.$date[1].'-'.$date[0];
		if($format_envoye == "en" AND $format_retourne == "en") $date_publication = $date[2].'-'.$date[1].'-'.$date[0];
		if($format_envoye == "fr" AND $format_retourne == "en") $date_publication = $date[2].'-'.$date[1].'-'.$date[0];
		if($format_envoye == "fr" AND $format_retourne == "fr") $date_publication = $date[0].'-'.$date[1].'-'.$date[2];
		
		$date_publication = ereg_replace("-", "/", $date_publication);
		
	}else{
		
		$jour = date("d");
		$mois = date("m");
		$annee = date("Y");
		
		
		if($format_envoye == "en" AND $format_retourne == "fr") $date_publication = $jour.'-'.$mois.'-'.$annee;
		if($format_envoye == "en" AND $format_retourne == "en") $date_publication = $annee.'-'.$mois.'-'.$jour; 
		if($format_envoye == "fr" AND $format_retourne == "en") $date_publication = $annee.'-'.$mois.'-'.$jour;
		if($format_envoye == "fr" AND $format_retourne == "fr") $date_publication = $jour.'-'.$mois.'-'.$annee;
		
		$date_publication = ereg_replace("-", "/", $date_publication);

		
	}
	
	return $date_publication;
}


//pour retirer les accents d'une chaîne de caractère
function clean_text($str){
	
	/** strtr() sait gérer le multibyte */
	$str = strtr($str, array(
	'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'a'=>'a', 'a'=>'a', 'a'=>'a', 'ç'=>'c', 'c'=>'c', 'c'=>'c', 'c'=>'c', 'c'=>'c', 'd'=>'d', 'd'=>'d', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'e'=>'e', 'e'=>'e', 'e'=>'e', 'e'=>'e', 'e'=>'e', 'g'=>'g', 'g'=>'g', 'g'=>'g', 'h'=>'h', 'h'=>'h', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'i'=>'i', 'i'=>'i', 'i'=>'i', 'i'=>'i', 'i'=>'i', '?'=>'i', 'j'=>'j', 'k'=>'k', '?'=>'k', 'l'=>'l', 'l'=>'l', 'l'=>'l', '?'=>'l', 'l'=>'l', 'ñ'=>'n', 'n'=>'n', 'n'=>'n', 'n'=>'n', '?'=>'n', '?'=>'n', 'ð'=>'o', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'o'=>'o', 'o'=>'o', 'o'=>'o', 'œ'=>'o', 'ø'=>'o', 'r'=>'r', 'r'=>'r', 's'=>'s', 's'=>'s', 's'=>'s', 'š'=>'s', '?'=>'s', 't'=>'t', 't'=>'t', 't'=>'t', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'u'=>'u', 'u'=>'u', 'u'=>'u', 'u'=>'u', 'u'=>'u', 'u'=>'u', 'w'=>'w', 'ý'=>'y', 'ÿ'=>'y', 'y'=>'y', 'z'=>'z', 'z'=>'z', 'ž'=>'z'
	));
	
	return $str;
}

// Recupere la signature d'un photographe 
function recupere_signature($id,$nohtml,$mysql_link){

	
	
	$req = "SELECT nom,signature_photographe FROM m_tag WHERE id_cat = 33 AND id = ".$id;
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
	
	
	if(!empty($nohtml)){
		$signature = $res['nom'];
	}else{
		$signature = $res['signature_photographe'];
	}
	
	return $signature;
}


// Recupere la signature d'un photographe 
function recupere_url_signature($id,$mysql_link){

	
	
	$req = "SELECT nom_fichier FROM m_tag WHERE id_cat = 33 AND id = ".$id;
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
	
	$url_signature = $res['nom_fichier'];
		
	return $url_signature;
}


//compte le nombre de contenu

function nbrcontent($table,$condition1,$valeur1,$condition2,$valeur2,$valeur_personnalise,$mysql_link){

	


	$req = 'SELECT id FROM '.$table;
	
	if(!empty($condition1))$req .= " WHERE ".$condition1."=".$valeur1;
	if(!empty($valeur2))$req .= ' AND '.$condition2.'='.$valeur2; 
	
	if(!empty($valeur_personnalise)) $req .= $valeur_personnalise;
	
	$query = mysqli_query($mysql_link,$req);
	$nbr = mysqli_num_rows($query);
	
	return $nbr;
}

//on recupere les donnees

function donnee($table,$condition1,$valeur1,$condition2,$valeur2,$mysql_link){

	


	$req = "SELECT * FROM ".$table;

	if(!empty($condition1))$req .= " WHERE ".$condition1."=".$valeur1;
	if(!empty($condition2))$req .= " AND ".$condition2."=".$valeur2;
	
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
		
	return $res;
}






//on recupere L'URL d'un fichier après http://www.mango-surf.com/
function urlFichier($id,$id_rubrique,$mysql_link){
	
	$sommaire = "";
	
	$parametreUrl = explode("-",$id_rubrique);

	
	// $parametreUrl[0] = id_rubrique
	// $parametreUrl[1] = id_photographe

	
	
	
	if($parametreUrl[0] != 18){
		$req_rubrique = "SELECT chemin,nom_table FROM m_rubrique WHERE id = ".$parametreUrl[0];
		$query_rubrique = mysqli_query($mysql_link,$req_rubrique);
		$res_rubrique = mysqli_fetch_array($query_rubrique);
		
		$req = "SELECT id_cat,nom_fichier FROM ".$res_rubrique['nom_table']." WHERE id=".$id;
		$query = mysqli_query($mysql_link,$req);
		$res = mysqli_fetch_array($query);	
		
		$chemin = $res_rubrique['chemin'];
		$nom_fichier = $res['nom_fichier'];
		
		//rubrique culture et trip
		if(($parametreUrl[0] == 4) OR ($parametreUrl[0] == 6)){
			$sommaire = "-".idsommaire($id,$mysql_link);
			
		}
		
		//rubrique culture et trip
		if(($parametreUrl[0] == 5) OR ($parametreUrl[0] == 3)){
			$pres_sommaire = "s-";
		}
		
		//rubrique photo
		if($parametreUrl[0] == 17){
			$cat_url = "-".$res['id_cat'];
		}
		
		//photographe
		if(!empty($parametreUrl[1])){
			$photographe = "-".$parametreUrl[1];
		}


		
		$nom_de_fichier = $chemin.$pres_sommaire.$res['nom_fichier']."--".$id.$sommaire.$cat_url.$photographe.".html";

	}
	
	if($parametreUrl[0] == 18){
	
		//URL special pour les tag, photographe, shopping et autre
	
		$req = "SELECT id_cat,nom_fichier FROM m_tag WHERE id=".$id;
		$query = mysqli_query($mysql_link,$req);
		$res = mysqli_fetch_array($query);
		
		if($res['id_cat'] == 32){
			$nom_de_fichier = "shopping/marque/".$res['nom_fichier'].'--'.$id.'-1.html';
		}elseif($res['id_cat'] == 33){
			$nom_de_fichier = "galerie-photo/photographe/".$res['nom_fichier'].'--'.$id.'-1.html';
		}else{
			$nom_de_fichier = "tag/".$res['nom_fichier'].'--'.$id.'-1.html';
		}
	}
	
	
	return $nom_de_fichier;
}




//on recupere le chemin de la rubrique
function cheminrubrique($id_rubrique,$mysql_link){
	
	
	
	$req = "SELECT chemin FROM m_rubrique WHERE id=".$id_rubrique;
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
	
	$chemin_rubrique = $res['chemin'];
	
	return $chemin_rubrique;
}

//on recupere le titre du dossier ou Trip + URL
function titresommaire($id,$mysql_link){
	
	
	
	$req = "SELECT titre, nom_fichier FROM m_editorial WHERE id=".$id;
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
	
	$tab[0] = $res['titre'];
	$tab[1] = "s-".$res['nom_fichier']."--".$id.".html";
	
	return $tab;
}


//on recupere l'ID du dossier ou Trip

function idsommaire($id,$mysql_link){
	
	
	
	$id_sommaire = "";
	
	$req = "SELECT id_sommaire FROM m_editorial WHERE id=".$id;
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
	
	$id_sommaire = $res['id_sommaire'];
	
	
	return $id_sommaire;
}


//introduction sur les pages d'accueil des rubrique

function introduction($id_rubrique,$option1,$valeur1,$option2,$valeur2,$option3,$valeur3,$mysql_link){

	
	
	$req = "SELECT titre, presentation FROM m_rubrique WHERE id=".$id_rubrique;
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
	
	
	$introduction  = '<div class="bloc_arrondie overflow mrgT20 mrgB20 pad10" id="introduction">';
	$introduction .= '<h1 class="accroche">'.$res['titre'].'</h1>';
	$introduction .= $res['presentation'];
	
	//option1 == agenda
	if($option1 == 1){
		$introduction .= $valeur1;	
	}
	
	
	$introduction .= '</div>';
	
	return $introduction;
}


//on recupere l'URL de la page Tag
function UrlTag($id_tag,$motcle,$mysql_link){
	
	
	
	$req = "SELECT id,nom_fichier FROM m_tag WHERE id=".$id_tag;
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
	
	$url_tag = '<a href="/tag/'.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$motcle.'">'.$motcle.'</a>';
	
	return $url_tag;
}

//on recupere le nom de la marque
function marque($id_marque,$mysql_link){
	
	
	
	$req = "SELECT nom FROM m_tag WHERE id=".$id_marque;
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
	
	$marque = $res['nom'];
	
	return $marque;
}

//on recupere l'url d'une marque
function Urlmarque($id_marque,$mysql_link){
	
	
	
	$req = "SELECT nom_fichier FROM m_tag WHERE id=".$id_marque;
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
	
	$urlmarque = $res['nom_fichier'];
	
	return $urlmarque;
}

//on recupere le nom de la rubrique
function rubrique($id_rubrique,$mysql_link){
	
	
	
	$req = "SELECT nom FROM m_rubrique WHERE id=".$id_rubrique;
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
	
	$rubrique = $res['nom'];
	
	return $rubrique;
}

//recupere id rubrique
function idRubrique($id,$table,$mysql_link){
	
	$id_rubrique = "";
	
	
	
	$req_id_rubrique = "SELECT id_rubrique FROM ".$table." WHERE id = ".$id;
	$query_id_rubrique = mysqli_query($mysql_link,$req_id_rubrique);
	$res_id_rubrique = mysqli_fetch_array($query_id_rubrique);
	
	$id_rubrique = $res_id_rubrique['id_rubrique'];
	return $id_rubrique;
}


//on recupere le nom de la region
function region($id_region,$mysql_link){
	
	
	
	$req = "SELECT nom FROM m_region WHERE id=".$id_region;
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
	
	$region = $res['nom'];
	
	return $region;
}

//on recupere le nom de la region
function pays($id_pays,$mysql_link){
	
	
	
	$req = "SELECT nom FROM m_pays WHERE id=".$id_pays;
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
	
	$pays = $res['nom'];
	
	return $pays;
}

//fontion recupere timestamp
function dateFR2Time($date){
  list($year,$month,$day) = explode('-', $date);
  $timestamp = mktime(0, 0, 0, $month, $day, $year);
  return $timestamp;
}


//on recupere le nom de la categorie
function categorie($id_categorie,$mysql_link){
	
	
	
	$req = "SELECT nom FROM m_cat WHERE id=".$id_categorie;
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
	
	$categorie = $res['nom'];
	
	return $categorie;
}

//on recupere le nom de la categorie
function UrlCategorie($id_categorie,$mysql_link){
	
	
	
	$req = "SELECT nom_fichier FROM m_cat WHERE id=".$id_categorie;
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
	
	$urlcategorie = $res['nom_fichier'];
	
	return $urlcategorie;
}





//on recupere l'ID de la categorie de la photo
function id_cat_photo($id_photo,$mysql_link){
	
	
	
	$req = "SELECT id_cat FROM m_photo WHERE id=".$id_photo;
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
	
	$id_cat_photo = $res['id_cat'];
	
	return $id_cat_photo;
}


//on recupere le nom du dossier de la categorie
function DossierCategorie($id_categorie,$mysql_link){
	
	
	
	$req = "SELECT dossier FROM m_cat WHERE id=".$id_categorie;
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
	
	$dossiercategorie = $res['dossier'];
	
	return $dossiercategorie;
}

//on recupere le mois
function recupere_mois($id_mois){
	
	$tabmois = array(1 => "Janvier",2 =>"Février",3 =>"Mars",4 =>"Avril",5 =>"Mai",6 =>"Juin",7 =>"Juillet",8 =>"Août",9 =>"Septembre",10 =>"Octobre",11 =>"Novembre",12 =>"Décembre");			
	
	$mois = $tabmois[$id_mois];
	
	return $mois;
}


//on construit un lien
function lien($nom,$url,$target,$follow,$crypte){

	if(!empty($crypte)){
	
		$lien ='';
	
	}else{
	
		$lien = '<a href="'.$url.'" title="'.stripslashes($nom).'" target="'.$target.'">'.stripslashes($nom).'</a>';
	}
	
	return $lien;
}


//On affiche les dernières news
function dernierenews($option1,$valeur1,$option2,$valeur2,$option3,$valeur3,$option4,$valeur4,$mysql_link){

	

	$derniere_news  = '';
	
	$derniere_news .= '<section class="phone-hidden bgBlack grid pa2 mt2"><div class="grid3">';
	
	$req = "SELECT * FROM m_editorial WHERE ".$option1." = ".$valeur1." AND en_ligne = 1 AND date_publication < NOW()";
	
	
	if(!empty($option2)){
		$req .= " AND ".$option2."<".$valeur2;
	}
	
	
	$req .= " ORDER BY date_publication DESC LIMIT 0,3";
	
	$query = mysqli_query($mysql_link,$req);

	
	
	while($res = mysqli_fetch_array($query)){
	
		$cheminrubrique = cheminrubrique($res['id_rubrique'],$mysql_link);

		
		$derniere_news .= '<div>';
		$derniere_news .= '<a href="/'.$cheminrubrique.$res["nom_fichier"].'--'.$res["id"].'.html" title="'.$res['titre'].'""><img src="/lib/image/editorial/'.$res['userfile3'].'" alt="'.$res['titre'].'" class="clear" /></a>';
		$derniere_news .= '<a href="/'.$cheminrubrique.$res["nom_fichier"].'--'.$res["id"].'.html" title="'.$res['titre'].'" class="small fontWhite">'.tronquer($res['titre'],180).'</a>';
		$derniere_news .= '</div>';
	
	}
	
	$derniere_news .= '</div></section>';
	
	return $derniere_news;

}


//On affiche les dernières news
function dernierephoto($option1,$valeur1,$option2,$valeur2,$option3,$valeur3,$option4,$valeur4,$mysql_link){

	

	$derniere_news  = '';
	
	$derniere_news .= '<section class="line grid bgBlack pa2 mt2"><div class="grid3">';

	$req = "SELECT * FROM m_photo WHERE en_ligne = 1";
	
	if(!empty($option1)){
		$req .= " AND ".$option1."=".$valeur1;
	}
	

	$req .= " ORDER BY rand() LIMIT 0,3";
	$query = mysqli_query($mysql_link,$req);
	
	

	
	$i = 1;
	
	while($res = mysqli_fetch_array($query)){
	
		
	$derniere_news .= '<div>';
	$derniere_news .= '<a href="'.$option4.$res["nom_fichier"].'--'.$res["id"].'-'.$res['id_cat'].'.html" title="'.$res['legende'].'"><img src="/lib/image/photo/'.$res['userfile3'].'" alt="'.$res['legende'].'"  /></a>';
	$derniere_news .= '</div>';

	$i++;
	}
	
	$derniere_news .= '</div></section';
	
	return $derniere_news;

}

//PUB shopping
function pubshopping($id_content,$id_produit,$mysql_link){
	
	$i=0;
	
	$pub_shopping = "";
	$pub_shopping .= "<section class='line grid mt2 mb2 border-2-top border-2-bottom pb2 pt2'><div class='grid3'>";

	//Si j'ai une selection de produit
	if(!empty($id_produit)){
	
		$id_produits = explode("-",$id_produit);
		
		while ($id_produits[$i] != ""){
	
			$req_shopping = "SELECT id, id_rubrique, titre, userfile2, nom_fichier FROM m_shopping WHERE id = ".$id_produits[$i];
			$query_shopping = mysqli_query($mysql_link,$req_shopping);
			$res_shopping = mysqli_fetch_array($query_shopping);
		
			$pub_shopping .= '<div><a href="/'.urlFichier($res_shopping['id'],$res_shopping['id_rubrique'],$mysql_link).'" title="'.$res_shopping['titre'].'"><img class="borderGray" src="/lib/image/shopping/'.$res_shopping['userfile2'].'" alt="'.$res_shopping['titre'].'" /></a><br />';
			$pub_shopping .= '<a href="/'.urlFichier($res_shopping['id'],$res_shopping['id_rubrique'],$mysql_link).'" title="'.$res_shopping['titre'].'" class="small">'.$res_shopping['titre'].'</a></div>';
		$i++;
		}
	}else{
	
		$req_shopping = "SELECT id, id_rubrique, titre, userfile2, nom_fichier FROM m_shopping WHERE (id > ((SELECT id FROM m_shopping ORDER BY id DESC LIMIT 0,1) - 900)) ORDER BY RAND() LIMIT 0,3";
		$query_shopping = mysqli_query($mysql_link,$req_shopping);
		
		
		while ($res_shopping = mysqli_fetch_array($query_shopping)){
			$pub_shopping .= '<div><a href="/'.urlFichier($res_shopping['id'],$res_shopping['id_rubrique'],$mysql_link).'" title="'.$res_shopping['titre'].'"><img class="borderGray" src="/lib/image/shopping/'.$res_shopping['userfile2'].'" alt="'.$res_shopping['titre'].'" /></a><br />';
			$pub_shopping .= '<a href="/'.urlFichier($res_shopping['id'],$res_shopping['id_rubrique'],$mysql_link).'" title="'.$res_shopping['titre'].'" class="small">'.$res_shopping['titre'].'</a></div>';	
		}
	
	}
	
	
	$pub_shopping .= "</div></section>";
	
	return $pub_shopping;

}



//plus de contenue
function plusdecontenu($titre,$id_content,$table,$mysql_link){

	$page ='<div class="titreRubrique mod mb2 mt2">A ne pas manquer</div>';


	
	$i = 0;
	$id_news = explode("-",$id_content);
	
	while ($id_news[$i] != ""){
		
		$req_news = "SELECT id, id_rubrique, date_publication, titre, chapeau, nom_fichier, userfile1 FROM ".$table." WHERE id=".$id_news[$i];
		$query_news = mysqli_query($mysql_link,$req_news);
		$res_news = mysqli_fetch_array($query_news);
		
			
		//$page .= '<a class="small" href="/'.urlFichier($id_news[$i],$res_news['id_rubrique'],$mysql_link).'" title="'.$res_news["titre"].'">'.$res_news["titre"].'</a><br />';
		
		
		$page .= listing_classique($res_news['id'],"../lib/image/editorial/".$res_news['userfile1'],"",$res_news['titre'],$res_news['chapeau'],$res_news['nom_fichier'],$commentaire,$res_news['date_publication'],$i,70,120,$id_region,$p,$mysql_link);
		
		
					
		$i++;
	}
	
		
	return $page;
}


//plus de photo
function plusdephoto($titre,$id_content,$table,$mysql_link){

	
	
	
	if($titre == "Voir plus de photos"){ $rel = 'rel="nofollow"'; }

	$req_news = "SELECT id_rubrique,id_cat,nom_fichier FROM ".$table." WHERE id=".$id_content;
	$query_news = mysqli_query($mysql_link,$req_news);
	$res_news = mysqli_fetch_array($query_news);
			
	$cheminrubrique = cheminrubrique($res_news["id_rubrique"],$mysql_link);
	
	
	if($titre == "Voir plus de photos"){
		$page = '<div class="mod right pa1 bgRed"><a '.$rel.' href="/galerie-photo/'.$res_news["nom_fichier"].'--'.$id_content.'-'.$res_news["id_cat"].'.html" title="'.$res_news["titre"].'"><strong class="fontWhite">'.stripslashes($titre).'</strong></a></div>';
	}else{
		$page = '<div class="line"><a '.$rel.' href="/galerie-photo/'.$res_news["nom_fichier"].'--'.$id_content.'-'.$res_news["id_cat"].'.html" title="'.$res_news["titre"].'"><strong>'.stripslashes($titre).'</strong></a></div>';
	}
		
	return $page;
}



	
//presentation image
function image($fichier,$class_div,$legende,$copyright,$intexte,$rubrique,$nom_lien_photo,$id_plus_photo,$mysql_link){
	
	
	$image = '';
	
	$image .= '<figure class="mb1">';
	$image .= '<img itemprop="image" src="/lib/image/'.$rubrique.'/'.$fichier.'" alt="'.$legende.'" class="mod '.$class_div.'" /><div class="mod">';
	
	if((!empty($id_plus_photo)) && ($id_plus_photo >= 5520)){ 
		$image .= plusdephoto("Voir plus de photos",$id_plus_photo,"m_photo",$mysql_link); 
	}
	
	if((!empty($legende)) OR (!empty($copyright))){
		$image .="<figcaption><em class='small'>";
	}
	
	if(!empty($legende)){$image .=  $legende;}
	if(!empty($copyright)){$image .=  ' - '.$copyright;}
	
	if((!empty($legende)) OR (!empty($copyright))){
		$image .="</em></figcaption></div>";
	}
	
	
	$image .= '</figure>';
	
	
	return $image;
}


//recadrer une image
function miniature($filename,$width,$height,$rep){
    
    list($old_width, $old_height) = getimagesize($filename);
    
    
    // Redimensionnement
	$image_p = imagecreatetruecolor($width, $height);
	$image = imagecreatefromjpeg($filename);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $old_width, $old_height);

	// Affichage
	imagejpeg($image_p, null, 100);
}


//partage réseaux sociaux
function share($share,$class,$commentaire,$url,$titre,$tag,$mysql_link){
	
	if($tag != NULL){
		
		$tag_share = "";
		
		$tags = explode("-",$tag);
		$nbrtag = count($tags);
		
		
		for($i=0;($i+1)<=$nbrtag;$i++){
			$tag_share .= recupereNomTag($tags[$i],$mysql_link);
			
			if($i != $nbrtag){
			$tag_share .= ',';
			}
		}
	
	}else{
		$tag_share = 'SURF';
	}

	$share  ="";
	
	$share .= '<section class="line bgBlack">';
	$share .= '<div class="left pa05 colorFacebook"><a href="https://www.facebook.com/sharer/sharer.php?u='.$url.'" title="Partager sur Facebook" rel="nofollow" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700\');return false;"><img src="/lib/image/template/facebook.png" /></a></div>';
	$share .= '<div class="left pa05 colorTwitter"><a href="https://twitter.com/share?url='.$url.'&text='.$titre.'&hashtags='.$tag_share.'&via=www.mango-surf.com&related=mangosurf" rel="nofollow" title="Partager sur Twitter" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700\');return false;"><img src="/lib/image/template/twitter.png" /></a></div>';
	$share .= '<div class="left pa05 colorGoogle"><a href="https://plus.google.com/share?url='.$url.'" title="Partager sur Google+" rel="nofollow" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700\');return false;"><img src="/lib/image/template/google+.png" /></a></div>';
	
			
				
	if($commentaire == 1){
		
		$share .= '<div class="right pa05 inbl bgRed"><a href="#commentaire" class="fontWhite"><img src="/lib/image/template/commentaire.png" />&nbsp;Poste un commentaire</a></div>';
	}
				
	$share .= '</section>';


	return $share;
}

//Menu région
function menu_region($table,$id_rubrique,$id_cat,$id_region,$p,$mysql_link){

	
	
	if($id_cat != 29){
		$champ = "id_region";
	}else{
		$champ = "id_pays";
	}
	
	// on récupere le nom des region qui on du contenu
	$req_region = "SELECT ".$champ.", COUNT(*) FROM ".$table." WHERE ";
	
	if(!empty($id_rubrique)){
		$req_region .= "id_rubrique=".$id_rubrique;
	}else{
		$req_region .= "id_cat=".$id_cat;
	}
	
	$req_region .= " GROUP BY ".$champ." ORDER BY COUNT(*) DESC";
	
	$query_region = mysqli_query($mysql_link,$req_region);
	
	$menu_region = "";
	
	$menu_region .= '<select name="region" id="region" class="menu" onChange="ChangeUrl(this.form)">';
	$menu_region .= '<option value="0">Liste des régions</option>';

	while($res_region = mysqli_fetch_array($query_region)){
		
		if($id_region == $res_region[0]) $select = "selected";
		
		if(!empty($id_rubrique)){
			//rubrique actualité locale
			$menu_region .= '<option value="?id_region='.$res_region[0].'" '.$select.'>'.region($res_region[0],$mysql_link).'</option>';
		}else{
			//rubrique annuaire
			if($id_cat != 29){
				$menu_region .= '<option value="'.DossierCategorie($id_cat,$mysql_link).'-'.$id_cat.'-'.$res_region[0].'-1.html" '.$select.'>'.region($res_region[0],$mysql_link).'</option>';
			}else{
				$menu_region .= '<option value="'.DossierCategorie($id_cat,$mysql_link).'-'.$id_cat.'-'.$res_region[0].'-1.html" '.$select.'>'.pays($res_region[0],$mysql_link).'</option>';
			}
		}
		
		
		
		$select ="";
	}
	
	$menu_region .= '</select>';

	

	return $menu_region;
}


//page suivante - page precedente
function page_suivante($classement,$table,$id_content,$mysql_link){

	

	$menu_page = "";
	
	$classement_suivant = $classement+1 ;
	$classement_precedent = $classement-1 ;

	$req_suivant = "SELECT id, id_sommaire, nom_fichier, titre FROM ".$table." WHERE id_sommaire = ".$id_content." AND classement = ".$classement_suivant;
	$query_suivant = mysqli_query($mysql_link,$req_suivant);
	$res_suivant = mysqli_fetch_array($query_suivant);

	$req_precedent = "SELECT id, id_sommaire, nom_fichier, titre FROM ".$table." WHERE id_sommaire = ".$id_content." AND classement = ".$classement_precedent;
	$query_precedent = mysqli_query($mysql_link,$req_precedent);
	$res_precedent = mysqli_fetch_array($query_precedent);
	 
	$menu_page .= '<section class="line mt2 mb2 grid"><div class="mod grid2">';

	
	if  (!empty($res_precedent["nom_fichier"])){
		$menu_page .= '<div>';
		$menu_page .= '<div class="bouton txtcenter"><a class="fontWhite" title="'.$res_precedent["titre"].'" href="'.$res_precedent["nom_fichier"].'--'.$res_precedent["id"].'-'.$res_precedent["id_sommaire"].'.html"><strong class="small">Page précédente</strong></a></div>'; 
		$menu_page .= '</div>';
	}
	
	if  (!empty($res_suivant["nom_fichier"])){
		$menu_page .= '<div>';
		$menu_page .=  '<div class="bouton txtcenter"><a class="fontWhite" title="'.$res_suivant["titre"].'" href="'.$res_suivant["nom_fichier"].'--'.$res_suivant["id"].'-'.$res_suivant["id_sommaire"].'.html"><strong class="small">Page suivante</strong></a></div>';
		$menu_page .= '</div>';
	}
	
	$menu_page .= '</div></section>';
	
	return $menu_page;
}


//photo suivante - photo precedente
function photo_suivante($id,$id_cat,$s,$suivant,$precedent,$classique,$mysql_link){

	
	$menu_page = "";
	
	if((!empty($s)) OR (!empty($id_cat))){
	
		/*$variable_signature = "-0";
		$variable_categorie = "-0";*/
		
		if(!empty($s)){
			//si on check un portofolio
			$variable_categorie = "-".$id_cat;
			$variable_signature = "-".$s;
			$requette = " AND id_photographe = ".$s;
		}elseif(!empty($id_cat)){
			$variable_categorie = "-".$id_cat;
			$requette = " AND id_cat = ".$id_cat;
		}		
	}
	
	
	
	
	// on teste la présence d'une image precedente
	$req_img_avant = "SELECT id,nom_fichier, legende FROM m_photo WHERE id < ".$id.$requette." ORDER BY id DESC";
	$query_img_avant = mysqli_query($mysql_link,$req_img_avant);
	$res_img_avant = mysqli_fetch_array($query_img_avant);
	$existe_img_avant = mysqli_num_rows($query_img_avant);
	
	// on teste la présence d'une image suivante
	$req_img_apres = "SELECT id,nom_fichier, legende FROM m_photo WHERE id > ".$id.$requette." ORDER BY id ASC";
	$query_img_apres = mysqli_query($mysql_link,$req_img_apres);
	$res_img_apres = mysqli_fetch_array($query_img_apres);
	$existe_img_apres = mysqli_num_rows($query_img_apres);
	
	if(($suivant == 1) AND ($existe_img_apres > 0)){
		$menu_page .= '<a href="'.$res_img_apres['nom_fichier'].'--'.$res_img_apres['id'].$variable_categorie.$variable_signature.'.html" title="Photo - '.$res_img_apres['legende'].'" rel="nofollow">';
		$menu_page .= '<img src="/lib/image/template/precedent.png" alt="photo suivante" width="45" height="45" class="imgNoBorder" />';
		$menu_page .= '</a>';
	}
	
	if(($precedent == 1) AND ($existe_img_avant > 0)){
		$menu_page .= '<a href="'.$res_img_avant['nom_fichier'].'--'.$res_img_avant['id'].$variable_categorie.$variable_signature.'.html" title="Photo - '.$res_img_avant['legende'].'" rel="nofollow">';
		$menu_page .= '<img src="/lib/image/template/suivant.png" alt="photo précédente" width="45" height="45" class="imgNoBorder" />';
		$menu_page .= '</a>';
	}
	
	
	
	if($classique == 1){
	
		$menu_page .= '<section class="lien grid mt2 mb2"><div class="grid2">';
	
		//on construit le menu 
		if(!empty($existe_img_apres)){
			$menu_page .= '<div class="mb2"><div class="bouton txtcenter">';
			$menu_page .= '  <a href="'.$res_img_apres['nom_fichier'].'--'.$res_img_apres['id'].$variable_categorie.$variable_signature.'.html" title="Photo - '.$res_img_apres['legende'].'"><strong class="fontWhite">Photo précédente</strong></a> ';
			$menu_page .= '</div></div>';
		} 
	
		if(!empty($existe_img_avant)){
			$menu_page .= '<div class="mb2"><div class="bouton txtcenter">';
			$menu_page .= '<a href="'.$res_img_avant['nom_fichier'].'--'.$res_img_avant['id'].$variable_categorie.$variable_signature.'.html" title="Photo - '.$res_img_avant['legende'].'"><strong class="fontWhite">Photo suivante</strong></a>';
			$menu_page .= '</div></div>';
		} 
	
		$menu_page .= '</div></section>';
	
	}


	return $menu_page;

}

//On tronque un mot
function tronquer($description,$max_caracteres){
	
	// Test si la longueur du texte dépasse la limite
	if (strlen($description)>$max_caracteres){
	    
		// Séléction du maximum de caractères
		$description = substr($description, 0, $max_caracteres);
	
		// Récupération de la position du dernier espace (afin déviter de tronquer un mot)
		$position_espace = strrpos($description, " ");    
		$description = substr($description, 0, $position_espace);    
		
		$description  = strip_tags($description);
		
		// Ajout des "..."
		$description = $description."...";
	}
	
	return $description;
}

//fil d'ariane
function fil_ariance($ancre1,$lien1,$ancre2,$lien2,$ancre3,$lien3,$ancre4,$lien4){
	
	$ariane = '<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" id="ariane" class="ariane mb1">';
	
	
	if(!empty($ancre1)){
		$ariane .= '<a href="'.$lien1.'" title="L\'actualité du surf" itemprop="url"><span itemprop="title">L\'actualité du surf</span></a>';
	}
	if(!empty($ancre2)){
		$ariane .= ' » <span itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="" itemprop="child"><a href="'.$lien2.'" title="'.$ancre2.'" itemprop="url"><span itemprop="title">'.$ancre2.'</span></a></span>';
	}
	if(!empty($ancre3)){
		$ariane .= ' » <span itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="" itemprop="child"><a href="'.$lien3.'" title="'.$ancre3.'" itemprop="url"><span itemprop="title">'.$ancre3.'</span></a></span>';
	}
	if(!empty($ancre4)){
		$ariane .= ' » <span itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="" itemprop="child"><a href="'.$lien4.'" title="'.$ancre4.'" itemprop="url"><span itemprop="title">'.$ancre4.'</span></a></span>';
	}
	
	$ariane .= '</div>';
	
	return $ariane;
}


//listing news
function listing_classique($id,$vignette,$image_gd,$titre,$chapeau,$nom_fichier,$commentaire,$date_pubication,$i,$height,$width,$id_region,$p,$mysql_link){
	
	$classimpaire = "";
	$listing = '';

	
	if((($p==1) AND ($i==0)) AND (empty($id_region)) AND (!empty($jetestesans))){
		
		/************************************* Pour réaliser le bloc a la une *************************************/
		
		
		/************************************* Pour réaliser le bloc a la une *************************************/
	
	}else{
		
		$idRubrique = idRubrique($id,"m_editorial",$mysql_link);
		$url = urlFichier($id,$idRubrique,$mysql_link);
		

			$listing .= '<article class="line mb1 pa1 zebre" itemscope itemtype="http://schema.org/Article">';
	
			if((file_exists($vignette)) AND (!empty($vignette))){
				$listing .= '<a href="/'.$url.'" title="'.$titre.'" rel="nofollow"><img width="'.$width.'" height="'.$height.'" class="left" src="'.$vignette.'" alt="'.$titre.'" align="left" /></a>';
			}

			$listing .= '<a href="/'.$url.'" title="'.$titre.'"><h1 class="h3-like p-reset m-reset">'.$titre.'</h1></a>';

			$listing .= '<span class="phone-hidden">'.tronquer($chapeau,90).'</span>';	
			
			if((!empty($date_pubication)) AND ($date_pubication != "0000-00-00")){
				$listing .= '<strong class="small phone-hidden">Publié le '.dateformat($date_pubication,"en","fr")."</strong>";
			}

	
			
	
		$listing .= '</article>';
	}
	
	return $listing;
	
}

//listing shopping
function listing_shopping($id,$i,$nbr_shopping,$marque,$mysql_link){
	
	//on rérupère les donnees
	$res = donnee("m_shopping","id",$id,"","",$mysql_link);
	
	if(!empty($marque)){
		$path_shopping = "../";
	}
	
	if($i%2 != 1){$listing .= '<section class="line zebre pa1 grid mb2"><div class="grid2">';}




	$listing .= '<div class="mod">';
	$listing .= '<a href="'.$path_shopping.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'" rel="nofollow"><img width="140" height="140" class="left borderGray" src="'.$path_shopping.'../lib/image/shopping/'.$res["userfile3"].'" alt="'.$res['titre'].'" /></a>';
	$listing .= '<a href="'.$path_shopping.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'"><h2 class="h2-like m-reset">'.tronquer($res['titre'],60).'</h2></a>';
	$listing .= tronquer($res['corps'],50);
	$listing .= '</div>';

	if(($i%2 == 1) OR ($nbr_shopping == ($i+1))){$listing .= '</div></section>';}		
	
	return $listing;
	
}



//On affiche les dernières news
function derniershopping($option1,$valeur1,$option2,$valeur2,$option3,$valeur3,$option4,$valeur4,$mysql_link){



	$req = "SELECT * FROM m_shopping WHERE ".$option1." = ".$valeur1." AND en_ligne = 1 ";
	
	
	if(!empty($option2)){
		$req .= " AND ".$option2."<".$valeur2;
	}
	
	
	$req .= " ORDER BY id DESC LIMIT 0,5";
	$query = mysqli_query($mysql_link,$req);

	$dernier_shopping  = '';

	$dernier_shopping .= '<section class="phone-hidden mt2 mb2"><div class="titreRubrique line mb1">Encore plus de shopping !</div>';
	
	while($res = mysqli_fetch_array($query)){
	
		$cheminrubrique = cheminrubrique($res['id_rubrique'],$mysql_link);

		
		$dernier_shopping .= '<div class="zebre line pa1">';
		$dernier_shopping .= '<a href="/'.$cheminrubrique.$res["nom_fichier"].'--'.$res["id"].'.html" title="'.$res['titre'].'""><img src="/lib/image/shopping/'.$res['userfile3'].'" alt="'.$res['titre'].'" class="left" /></a>';
		$dernier_shopping .= '<a href="/'.$cheminrubrique.$res["nom_fichier"].'--'.$res["id"].'.html" title="'.$res['titre'].'">'.$res['titre'].'</a><br />';
		$dernier_shopping .= strip_tags(tronquer($res['corps'],400));
		$dernier_shopping .= '</div>';
	
	}

	$dernier_shopping .= '</section>';
	return $dernier_shopping;
}



//listing agenda
function listing_agenda($id,$i,$mois,$mysql_link){


	//on rérupère les donnees
	$res = donnee("m_agenda","id",$id,"","",$mysql_link);
	
	if(!empty($mois)){
	
		$listing .= '<div class="titreRubrique line mb2">'.$mois.'</div>';
		
	}else{
		$listing .= '<div class="line mb1 pa1 zebre" itemscope itemtype="http://schema.org/Event">';
		$listing .= '<a href="'.$res["nom_fichier"].'--'.$res['id'].'.html" title="'.$res["titre"].'"><h1 class="h3-like m-reset p-reset" itemprop="name">'.$res['titre'].'</h1></a>';
		$listing .= '<time itemprop="startDate" datetime="'.$res["date_debut"].'T00:00">Du '.dateformat($res["date_debut"],"en","fr").'</time> au <time itemprop="endDate" datetime="'.$res["date_fin"].'T00:00">'.dateformat($res["date_fin"],"en","fr").'</time> à </span><span itemprop="location">'.$res['lieu'].'</span>';
		$listing .= '</div>';
	}
		
	
	
	return $listing;
	
}


//listing lexique
function listing_lexique($id,$i,$nbr_lexique,$mysql_link){

	$listing="";

	//on rérupère les donnees
	$res = donnee("m_tag","id",$id,"","",$mysql_link);
	
	$listing .= '<section class="line pa1 mb1 zebre">';	
	$listing .= '<a href="../tag/'.$res['nom_fichier'].'--'.$res['id'].'.html" title="Consulter la définition de '.$res['nom'].'"><h2 class="h2-like m-reset">'.$res['nom'].'</a></h2>'.tronquer($res['corps'],150);
	$listing .= '</section>';

	
	return $listing;
	
}



//listing annuaire
function listing_annuaire($id,$i,$nbr_annuaire,$mysql_link){
	
	
	

	//on rérupère les donnees
	$res = donnee("m_annuaire","id",$id,"","",$mysql_link);
	

	if($i%2 != 1){$listing .= '<section class="line grid zebre pa1 mb2"><div class="grid2">';}	
	
			
	$listing .= '<div>';
	$listing .= '<a href="'.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'" rel="nofollow"><img width="90" height="90" class="left borderGray" src="../lib/image/annuaire/'.$res["userfile1"].'" alt="'.$res['titre'].'" align="left" /></a>';
	$listing .= '<a href="'.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'"><h2 class="h2-like m-reset">'.tronquer($res['titre'],75).'</h2></a>';
	$listing .= '<span>'.tronquer($res['corps'],100).'</span><br />';	
	$listing .= '<strong>'.region($res['id_region']).pays($res['id_pays']).'</strong>';
	$listing .= '</div>';
	
	if(($i%2 == 1) OR ($nbr_annuaire == ($i+1))){$listing .= '</div></section>';}
		
	return $listing;
	
}


//listing annonce
function listing_annonce($id,$i,$nbr_annuaire,$mysql_link){
	
	//on rérupère les donnees
	$res = donnee("m_editorial","id",$id,"","",$mysql_link);
		
	
	$listing .= '<section class="line pa1 zebre">';
	
	if(!empty($res["userfile1"])){
		$listing .= '<a href="'.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'" rel="nofollow"><img width="90" height="90" class="left" src="../lib/image/editorial/'.$res["userfile1"].'" alt="'.$res['titre'].'" align="left" /></a>';
	}else{
	
		$req_img = "SELECT image FROM m_cat WHERE id=".$res['id_cat'];
		$query_img = mysqli_query($mysql_link,$req_img);
		$res_img = mysqli_fetch_array($query_img);
		$listing .= '<a href="'.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'" rel="nofollow"><img width="90" height="90" class="left" src="../lib/image/template/'.$res_img["image"].'" alt="'.$res['titre'].'" align="left" /></a>';

	}
	$listing .= '<a href="'.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'"><h2 class="h2-like m-reset">'.tronquer($res['titre'],75).'</h2></a>';
	$listing .= '<p class="small"><strong>'.categorie($res['id_cat'],$mysql_link).'</strong> - '.tronquer($res['corps'],190).'</p>';	
	
	$listing .= '</section>';
	
	return $listing;
	
}






//listing galerie photo
function listing_photo($id,$i,$id_photographe,$width,$height,$listing_photographe,$nbr_photo,$mysql_link){
	
	
	

	$classimpaire = "";

	
	if($i%2 != 1){
		$listing .= '<section class="line zebre pa1 grid mb2"><div class="grid2">';
	}
	
	if(!empty($id_photographe)){
		$id_photographe = "-".$id_photographe;
		$path_image = "../";
	}
	
			
	$listing .= '<div class="mod">';
	
	if($listing_photographe == 1){
		
		//on rérupère les donnees des photographes
		$res = donnee("m_tag","id",$id,"","",$mysql_link);

		$listing .= '<a href="/galerie-photo/photographe/'.recupere_url_signature($res['id'],$mysql_link).'-'.$res['id'].'-1.html" title="'.$res['nom'].'" rel="nofollow"><img width="'.$width.'" height="'.$height.'" class="left" src="../../lib/image/photo/photographe/'.$res['userfile1'].'" alt="'.$res['nom'].'" align="left" /></a>';
		$listing .= '<h2 class="h3-like m-reset">'.$res['nom'].'</h2>';
		$listing .= '<span class="font12">Découvrez les plus belles photos du photographe '.$res['nom'].'</span><br />';
		$listing .= '<a href="/galerie-photo/photographe/'.recupere_url_signature($res['id'],$mysql_link).'-'.$res['id'].'-1.html" title="'.$res['nom'].'" class="font12">Voir les photos de '.$res['nom'].'</a>';

	}else{
	
		//on rérupère les donnees des photos
		$res = donnee("m_photo","id",$id,"","",$mysql_link);

		$listing .= '<a href="/galerie-photo/'.$res['nom_fichier'].'--'.$res['id'].'-'.$res['id_cat'].$id_photographe.'.html" title="'.$res['legende'].'" rel="nofollow"><img width="'.$width.'" height="'.$height.'" class="left" src="'.$path_image.'../lib/image/photo/'.$res["userfile1"].'" alt="'.$res['legende'].'" align="left" /></a>';
		$listing .= '<a href="/galerie-photo/'.$res['nom_fichier'].'--'.$res['id'].'-'.$res['id_cat'].$id_photographe.'.html" title="'.$res['legende'].'"><h2 class="h3-like m-reset">'.tronquer($res['legende'],75).'</h2></a>';
	
		if(!empty($res['copyright'])){
			$listing .= '<span class="small">© '.$res['copyright'].'</span>';
		}else{
			$listing .= '<span class="small">© '.recupere_signature($res['id_photographe'],"1",$mysql_link).'</span>';
		}
	}
	
	
				
	$listing .= '</div>';
	
	if(($i%2 == 1) OR ($nbr_photo == ($i+1))){
		$listing .= '</div></section>';
	}
	
	return $listing;
	
}




//listing galerie photo Admin
function listing_photo_admin($id,$i,$id_photographe,$width,$height,$mot_cle,$identifiant,$id_cat,$id_photographe,$nbr_photo,$mysql_link){
	
	
	

	$classimpaire = "";

	
	if($i%2 != 1){
		$listing .= '<section class="line zebre pa1 grid mb2"><div class="grid2">';
	}	
	
	
			
	$listing .= '<div class="mod">';
	
		
	//on rérupère les donnees des photos
	$res = donnee("m_photo","id",$id,"","",$mysql_link);

    $listing .= '<strong>'.$res['id'].'</strong>';
    $listing .= '<a href="/galerie-photo/'.$res['nom_fichier'].'--'.$res['id'].'-'.$res['id_cat'].$id_photographe.'.html" title="'.$res['legende'].'" rel="nofollow"><img width="'.$width.'" height="'.$height.'" class="left" src="../../lib/image/photo/'.$res["userfile1"].'" alt="'.$res['legende'].'" align="left" /></a>';
	$listing .= '<div style="height:45px;">'.tronquer($res['legende'],60).'</div>';
	$listing .= '<br />';
	$listing .= '<a target="_blank" href="/galerie-photo/'.$res['nom_fichier'].'--'.$res['id'].'-'.$res['id_cat'].$id_photographe.'.html" title="'.$res['legende'].'" rel="nofollow"><img src="/lib/image/template/a-voir.png" class="" height="20" width="20" valign="middle" alt="voir" /></a>';
	$listing .= '<a href="ajout.php?id='.$res['id'].'&id_rubrique='.$res['id_rubrique'].'" title="Modifier"><img src="/lib/image/template/a-modifier.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" alt="modifier" /></a>';
	$listing .= '<a onClick="if (confirm(\'Etes vous certain de vouloir suprimer ! \')) document.location.href=\'index.php?supp=1&id='.$res["id"].'&id_rubrique='.$res['id_rubrique'].'&identifiant='.$identifiant.'&mot_cle='.$mot_cle.'&id_cat='.$id_cat.'&id_photographe='.$id_photographe.'\'; else return false;" href="#"><img src="/lib/image/template/a-supprimer.png" alt="supprimer" class="ImgNoBorder" height="20" width="20" valign="middle" /></a>';




	$listing .= '</div>';
	
	if(($i%2 == 1) OR ($nbr_photo == ($i+1))){
		$listing .= '</div></section>';
	}
	
	return $listing;
	
}




//listing marque de surf
function listing_marque($id,$i,$width,$height,$nbr_marque,$mysql_link){
	
	
	if($i%2 != 1){$listing .= '<section class="line zebre grid mb2 pa1"><div class="grid2">';}
		
	//on rérupère les donnees des photographes
	$res = donnee("m_tag","id",$id,"","",$mysql_link);
	
	$listing .= '<div>';
	$listing .= '<a href="/shopping/marque/'.$res['nom_fichier'].'-'.$res['id'].'-1.html" title="'.$res['nom'].'" rel="nofollow"><img width="'.$width.'" height="'.$height.'" class="borderGray left" src="/lib/image/shopping/marque/'.$res['userfile1'].'" alt="'.$res['nom'].'" align="left" /></a>';
	$listing .= '<a href="/shopping/marque/'.$res['nom_fichier'].'-'.$res['id'].'-1.html" title="'.$res['nom'].'"><h2 class="h2-like m-reset">'.$res['nom'].'</h2></a>';
	$listing .= '<span>Découvrez les produits de la marque '.$res['nom'].'</span><br />';
	$listing .= '<a href="/shopping/marque/'.$res['nom_fichier'].'-'.$res['id'].'-1.html" title="'.$res['nom'].'" class="small" rel="nofollow">Voir '.$res['nom'].'</a>';
	$listing .= '</div>';
	
	if(($i%2 == 1 OR ($nbr_marque == ($i+1)))){
		$listing .= '</div></section>';
	}
	
	return $listing;
}

//MISE EN AVANT 4 articles HOME

function mega_une_home($res1,$res2,$res3,$res4,$mysql_link){
	
	if( (!empty($res1['id_photographe'])) OR  (!empty($res1['id_photographe'])) ){
		$id_rubrique_article1 = $res1['id_rubrique']."-".$res1['id_photographe'];
		$chemin_image1 = "lib/image/photo/";

	}else{
		$id_rubrique_article1 = $res1['id_rubrique'];
		$chemin_image1 = "lib/image/editorial/";
	}
	
	if($res1['id_rubrique'] == 9){ $play ='<div class="play play-grand">&nbsp;</div>';}

	
	$mega_une = '';
	
	$mega_une .= '<article itemscope itemtype="http://schema.org/Article" class="line bgBlack mb2">';
	$mega_une .= '<div class="left mod tabW100 relative"><a itemprop="url" href="/'.urlFichier($res1['id'],$id_rubrique_article1,$mysql_link).'" title="'.stripslashes($res1['titre']).'">'.$play.'<img itemprop="image" src="'.$chemin_image1.$res1['photo'].'" alt="'.stripslashes($res1['legende']).'" width="660" height="330" class="borderRightWithe tabW100" /></a></div>';
	$mega_une .= '<time itemprop="dateCreated" datetime="'.$res1["date_publication"].'\'T00:00"></time>';
	$mega_une .= '<div class="mod pa2 tabblet-clearB">';
	$mega_une .= '<a itemprop="url" href="'.urlFichier($res1['id'],$id_rubrique_article1,$mysql_link).'" title="'.$rub_titre1.stripslashes($res1['titre']).'"><h1 class="m-reset p-reset h1-like fontWhite" itemprop="headline">'.$rub_titre1.stripslashes($res1['titre']).'</h1></a>';
	$mega_une .= '<p class="mod mt1 big fontWhite phone-hidden" itemprop="description">'.stripslashes($res1['chapeau']).'</p>';
	$mega_une .= '</div>';
	$mega_une .= '</article>';
	
	$mega_une .= '<section class="line mb2 grid">';
	$mega_une .= '<div class="grid3">';
	
	$i = 1;
	$play ='';
	$tab = array($res2,$res3,$res4);
	
	
	
	for ($i = 0; $i <= 2; $i++){
	
		if( (!empty($tab[$i]['id_photographe'])) OR  (!empty($tab[$i]['id_photographe'])) ){
			$id_rubrique_article = $tab[$i]['id_rubrique']."-".$tab[$i]['id_photographe'];
			$chemin_image = "lib/image/photo/";

		}else{
			$id_rubrique_article = $tab[$i]['id_rubrique'];
			$chemin_image = "lib/image/editorial/";
		}

		if($tab[$i]['id_rubrique'] == 9){ $play ='<div class="play play-petit">&nbsp;</div>';}

		$mega_une .= '<div>';
		$mega_une .= '<article itemscope itemtype="http://schema.org/Article">';
		$mega_une .= '<div class="relative"><a itemprop="url" href="'.urlFichier($tab[$i]['id'],$id_rubrique_article,$mysql_link).'" title="'.stripslashes($tab[$i]['titre']).'">'.$play.'<img itemprop="image" src="'.$chemin_image.$tab[$i]['photo'].'" alt="'.stripslashes($tab[$i]['legende']).'" width="320" height="160" class="clear mb1" /></a></div>';
		$mega_une .= '<time itemprop="dateCreated" datetime="'.$tab[$i]["date_publication"].'\'T00:00"></time>';
		$mega_une .= '<a itemprop="url" href="'.urlFichier($tab[$i]['id'],$id_rubrique_article,$mysql_link).'" title="'.$rub_titre2.stripslashes($tab[$i]['titre']).'"><h1 class="h2-like m-reset" itemprop="headline">'.$rub_titre2.stripslashes($tab[$i]['titre']).'</h1></a>';
		$mega_une .= '<span itemprop="description">'.$tab[$i]['chapeau'].'</span>';
		$mega_une .= '</article>';
		$mega_une .= '</div>';
		
		$play='';
	}	
	
	$mega_une .= '</div>';
	$mega_une .= '</section>';
	
	return $mega_une;
}


//MISE EN AVANT 4 articles
function mega_une_2($res1,$query1,$mysql_link){
	
	
	$i = 1;
	$mega_une = '';

	while ($res1 = mysqli_fetch_array($query1)){ 
	
	if( (!empty($res1['id_photographe'])) OR  (!empty($res1['id_photographe'])) ){
		$id_rubrique_article1 = $res1['id_rubrique']."-".$res1['id_photographe'];
		$chemin_image1 = "/lib/image/photo/";

	}else{
		$id_rubrique_article1 = $res1['id_rubrique'];
		$chemin_image1 = "/lib/image/editorial/";
	}
	
		
		if($i==1){
			$mega_une .= '<article itemscope itemtype="http://schema.org/Article" class="line bgBlack mb2">';
			$mega_une .= '<div class="left mod tabW100"><a itemprop="url" href="/'.urlFichier($res1['id'],$id_rubrique_article1,$mysql_link).'" title="'.stripslashes($res1['titre']).'"><img itemprop="image" src="'.$chemin_image1.$res1['photo1'].'" alt="'.stripslashes($res1['legende']).'" width="660" height="330" class="borderRightWithe tabW100" /></a></div>';
			$mega_une .= '<time itemprop="dateCreated" datetime="'.$res1["date_publication"].'\'T00:00"></time>';
			$mega_une .= '<div class="mod pa2 tabblet-clearB">';
			$mega_une .= '<a itemprop="url" href="/'.urlFichier($res1['id'],$id_rubrique_article1,$mysql_link).'" title="'.$rub_titre1.stripslashes($res1['titre']).'"><h1 class="m-reset p-reset h1-like fontWhite" itemprop="headline">'.$rub_titre1.stripslashes($res1['titre']).'</h1></a>';
			$mega_une .= '<p class="mod mt1 big fontWhite phone-hidden" itemprop="description">'.stripslashes($res1['chapeau']).'</p>';
			$mega_une .= '</div>';
			$mega_une .= '</article>';

			$mega_une .= '<section class="line mb2 grid">';
			$mega_une .= '<div class="grid3">';
			
		}else{
		
			$mega_une .= '<div>';
			$mega_une .= '<article itemscope itemtype="http://schema.org/Article">';
			$mega_une .= '<a itemprop="url" href="/'.urlFichier($res1['id'],$id_rubrique_article1,$mysql_link).'" title="'.stripslashes($res1['titre']).'"><img itemprop="image" src="'.$chemin_image1.$res1['photo'].'" alt="'.stripslashes($res1['legende']).'" width="320" height="160" class="clear mb1" /></a>';
			$mega_une .= '<time itemprop="dateCreated" datetime="'.$res1["date_publication"].'\'T00:00"></time>';
			$mega_une .= '<a itemprop="url" href="/'.urlFichier($res1['id'],$id_rubrique_article1,$mysql_link).'" title="'.$rub_titre2.stripslashes($res1['titre']).'"><h1 class="h2-like m-reset" itemprop="headline">'.$rub_titre2.stripslashes($res1['titre']).'</h1></a>';
			$mega_une .= '<span itemprop="description">'.$res1['chapeau'].'</span>';
			$mega_une .= '</article>';
			$mega_une .= '</div>';
		}
	
	$i++;
	$chemin_image='';
	$id_rubrique_article='';
	$play='';
	}
	
	
	$mega_une .= '</div>';
	$mega_une .= '</section>';
	
	return $mega_une;
}


//MISE EN AVANT PHOTOS

function photo_une($rand,$id_photo,$mysql_link){

	$photo ='';
	
	$photo .= '<section class="line mb2 grid bgBlack pa2">';
	
	
	
	$req_photo_une = "SELECT id, id_cat, userfile3, legende, nom_fichier FROM m_photo";
	
	if($id_photo != NULL){
		$explode_id = explode("-",$id_photo);
		$req_photo_une .= " WHERE id IN (".$explode_id[0].",".$explode_id[1].",".$explode_id[2].")";
	}elseif($rand != NULL){
		$req_photo_une .= " WHERE id > 5503 ORDER BY rand() LIMIT 0,9";
	}else{
		$req_photo_une .= " ORDER BY id DESC LIMIT 0,3";
	}
	
	$query_photo_une = mysqli_query($mysql_link,$req_photo_une);
	
	$i=1;
	
	while($res_photo_une = mysqli_fetch_array($query_photo_une)){
		
		if(($i==1) OR ($i==4) OR ($i==7)){$photo .= '<div class="grid3 ">';}
		

		$photo .= '<div class="mb1">';
		$photo .= '<a href="/galerie-photo/'.$res_photo_une["nom_fichier"].'--'.$res_photo_une["id"].'-'.$res_photo_une['id_cat'].'.html" title="'.$res_photo_une['legende'].'"><img src="/lib/image/photo/'.$res_photo_une['userfile3'].'" alt="'.$res_photo_une['legende'].'" width="320" height="160" class="clear mb1" /></a>';
		$photo .= '<a href="/galerie-photo/'.$res_photo_une["nom_fichier"].'--'.$res_photo_une["id"].'-'.$res_photo_une['id_cat'].'.html" title="'.$res_photo_une['legende'].'" class="fontWhite">'.tronquer(stripslashes($res_photo_une['legende']),80).'</a>';
		$photo .= '</div>';
		
		if(($i==3) OR ($i==6) OR ($i==9)){$photo .= '</div>';}
		
		
		$i++;
	} 
		
			
		$photo .= '</section>';
		
		return $photo;
}

//MISE EN AVANT SHOPPING DANS L'ARTICLE

function shopping_une($titre,$id_shopping,$rand,$information,$mysql_link){

		$shopping='';
		
		if($titre == 1){
			$shopping .= '<div class="titreRubrique line mb2">Les dernières tendances</div>';
		}
		
		$shopping .= '<section class="line grid">';
		
		$req_shopping = "SELECT * FROM m_shopping ";
		
		if($id_shopping != NULL){
			$explode_id = explode("-",$id_shopping);
			$req_shopping .= "WHERE id IN (".$explode_id[0].",".$explode_id[1].",".$explode_id[2].",".$explode_id[3].",".$explode_id[4].",".$explode_id[5].",".$explode_id[6].",".$explode_id[7].",".$explode_id[8].")";
		}elseif($rand != NULL){
			$req_shopping .= "ORDER BY rand() LIMIT 0,9";
		}else{
			$req_shopping .= "WHERE (id > ((SELECT id FROM m_shopping ORDER BY id DESC LIMIT 0,1) - 9)) ORDER BY RAND() LIMIT 0,9";
		}
		
		$query_shopping = mysqli_query($mysql_link,$req_shopping);
			
			$i="1";
			$z="1";
			while ($res_shopping = mysqli_fetch_array($query_shopping)){ 
			
			
			if($i==4){$i=1;}
			if($i==1){$shopping .= '<div class="grid3 mb2">';}
			
			
			$shopping .= '<div itemscope itemtype="http://schema.org/Product" class="mb2">';
			$shopping .= '<a itemprop="url" href="shopping/'.$res_shopping['nom_fichier'].'--'.$res_shopping['id'].'.html" title="'.$res_shopping['titre'].'"><img itemprop="image" src="lib/image/shopping/'.$res_shopping['userfile2'].'" alt="'.$res_shopping['titre'].'" class="borderGray" /></a>';
			
			if($information != NULL){
			
				$shopping .= '<a itemprop="url" href="shopping/'.$res_shopping['nom_fichier'].'--'.$res_shopping['id'].'.html" title="'.$res_shopping['titre'].'"><strong>'.$res_shopping['titre'].'</strong></a>';
				$shopping .= '<p class="m-reset">'.tronquer($res_shopping['corps'],75).'</p>';
			}
			
			
			$shopping .= '</div>';

		
		if($i==3){$shopping .= '</div>';}
		
		$i++;
		$z++;
		$mrgDshopping="";
		$mrgBshopping="";
		}
		
		$shopping .= '</section>';
		
		return $shopping;

}

function shopping_une2($id_shopping,$rand,$mysql_link){

	$shopping = "";
	
	$shopping .= '<section class="line pa2 mb2 bgBlack grid">';
	$shopping .= '<div class="grid5">';
	
	$req_shopping = "SELECT * FROM m_shopping ";
	
	if($id_shopping != NULL){
		$explode_id = explode("-",$id_shopping);
		$req_shopping .= "WHERE id IN (".$explode_id[0].",".$explode_id[1].",".$explode_id[2].")";
	}elseif($rand != NULL){
		$req_shopping .= "ORDER BY rand() LIMIT 0,5";
	}else{
		$req_shopping .= "WHERE (id > ((SELECT id FROM m_shopping ORDER BY id DESC LIMIT 0,1) - 9)) ORDER BY RAND() LIMIT 0,5";
	}

	$query_shopping = mysqli_query($mysql_link,$req_shopping);
	
	while ($res_shopping = mysqli_fetch_array($query_shopping)){ 
		$shopping .= '<div>';
		$shopping .= '<a itemprop="url" href="/shopping/'.$res_shopping['nom_fichier'].'--'.$res_shopping['id'].'.html" title="'.$res_shopping['titre'].'"><img itemprop="image" src="/lib/image/shopping/'.$res_shopping['userfile2'].'" alt="'.$res_shopping['titre'].'" /></a>';
			$shopping .= '</div>';

	}
	
	$shopping .= '</div>';
	$shopping .= '</section>';
	
	return $shopping;

}



// Gestion des commentaire
function genere_commentaire($id_rubrique,$id_contenu,$ajout,$nom,$commentaire,$nom_fichier,$p,$ancre,$s,$link,$mysql_link) { 


	
	require("n_f-pager.php");
	require("f-formulaire.php");

	
?>

<div name="commentaire">

	<?php if((empty($link)) AND (!empty($ajout)) AND (!empty($commentaire)) AND (!empty($nom))){ 
	//Insert un nouveau commentaire
	
	$req_insert  = "INSERT INTO m_commentaire SET ";
	$req_insert .= "id_rubrique =\"".$id_rubrique."\" ";	
	
	$req_insert .= ",id_contenu = \"".$id_contenu."\" ";
	$req_insert .= ",nom =\"".strip_tags(addslashes($nom))."\" ";
	$req_insert .= ",corps =\"".strip_tags(addslashes($commentaire))."\" ";
	$req_insert .= ",etat = 0";
	
	//echo $req_insert;
	
	$query_insert = mysqli_query($mysql_link,$req_insert);
	$last_id = (last_id("m_commentaire")-1);
	
	
	echo '<div>Votre message a bien été enregistré !<br />Votre commentaire sera validé très rapidement</div>';
	
	$message =  'Nouveau commentaire<br /><br />';
	$message .= 'Nom : '.strip_tags($nom).'<br />';
	$message .= 'Commentaire : '.strip_tags($commentaire).'<br /><br />';
	$message .= 'Modifier  : http://www.mango-surf.com/admin/commentaire/ajout.php?id='.$last_id.'<br />';
	$message .= 'Supprimer  : http://www.mango-surf.com/admin/commentaire/index.php?supp=1&etat=1&id='.$last_id.'<br />';

	
	$headers = 'Content-type: text/html; charset=utf-8' . "\r\n";
	
	mail('romain@mango-surf.com', '[Mango-Surf.com] - Nouveau commentaire', $message,$headers);
	
	}else{ 

	?>

		
		<div id="commentaire" class="titreRubrique mod mb2 mt2">Publiez un commentaire</div>
		<section class="mb2 pa2 bgGrisClair">
			<div class="line">	
				<form method="POST" action="<?php echo $nom_fichier; ?>--<?php echo $id_contenu; ?><?php if($id_rubrique == 17){ echo "-".id_cat_photo($id_contenu); } ?><?php if(($id_rubrique == 17) AND (!empty($s))){ echo '-'.$s; }  ?><?php if(($id_rubrique == 4) OR ($id_rubrique == 6)){ echo '-'.idsommaire($id_contenu); } ?>.html#commentaire" name="commentaire" id="commentaire" onsubmit="return valid();">
				<?php 
			
				if(($id_rubrique == 7) OR ($id_rubrique == 6)){
					require("../../lib/formulaire/n_form-commentaire.php"); 
				}else{
				require("../lib/formulaire/n_form-commentaire.php"); 
				}	
				?>
				</form>
			</div>
		</section>
		
		<?php } ?>
		
		
		<?php
		
		//initialisation pager
		if ((empty($_GET['p'])) || ($_GET['p'] == 0)) $p = 1; else $p = $_GET['p'];
		$par_page = 8;
		
		$req =  "SELECT * FROM m_commentaire WHERE id_rubrique = ".$id_rubrique." AND id_contenu = ".$id_contenu." AND etat = 1 ORDER BY id DESC LIMIT ".(($p-1)*$par_page).",".$par_page;
		$query = mysqli_query($mysql_link,$req);
		
		
		
		$exist = nbrcontent("m_commentaire","id_rubrique",$id_rubrique,"id_contenu",$id_contenu," AND etat = 1",$mysql_link);
		
		
		if (!empty($exist)){
			
			echo '<section class="line">';
		
			while ($res = mysqli_fetch_array($query)){ 
			
		
		?>
		<div class="zebre line pa1">
			<strong><?php echo $res['nom'];?></strong><br />
			<?php echo $res['corps'];?>
		</div>	
			
			
		<?php }
		
		echo '</section><nav class="line mt2">';
		
		if($id_rubrique == 17){
			$variable_pager = id_cat_photo($id_contenu,$mysql_link);
		}
		
		
		if(!empty($s)){
			$variable_pager .= '-'.$s;
		}
		
		if(!empty($ancre)){
			$variable_pager .= $ancre;
		}
		
		
		echo $pager = pager_rewriting($exist,$par_page,$p,$nom_fichier."-",$id_contenu,"#commentaire",$variable_pager)."</nav>"; 
		
		}


		
		?>


</div>

<?php } ?>





