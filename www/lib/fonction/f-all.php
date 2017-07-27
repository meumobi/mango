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


//fonction affiche Tag
function afficheTag($id_tag,$mysql_link){
	
	//si on a des tags dans une news
	if(!empty($id_tag)){
		
		$liste_tag = '<strong>Tag : </strong>';

		$tag = explode("-",$id_tag);
		$nbrtag = count($tag);
		
		for($i=0;($i+1)<=$nbrtag;$i++){
			
			$req_tag = "SELECT id, id_rubrique, nom, nom_fichier FROM m_tag WHERE id=".$tag[$i];

			$query_tag = mysqli_query($mysql_link,$req_tag);
			$res_tag = mysqli_fetch_array($query_tag);
					
			$liste_tag .= '<a href="/'.urlFichier($tag[$i],$res_tag['id_rubrique'],$mysql_link).'" title="'.$res_tag["nom"].'">'.$res_tag["nom"].'</a>';
		
			if($nbrtag != ($i+1)){
				$liste_tag .= " - ";
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
			$sommaire = "-".idsommaire($id);
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
	
	$derniere_news .= '<div class="bloc_arrondie mrgT20 mrgB20 bggrisclair pad10 overflow">';
	//$derniere_news .= '<h4 class="fontBeigeFonce padB10 font16">'.$valeur4.'</h4>';
	
	$req = "SELECT * FROM m_editorial WHERE ".$option1." = ".$valeur1." AND en_ligne = 1 AND date_publication < NOW()";
	
	
	if(!empty($option2)){
		$req .= " AND ".$option2."<".$valeur2;
	}
	
	
	$req .= " ORDER BY date_publication DESC LIMIT 0,5";
	
	$query = mysqli_query($mysql_link,$req);

	
	$i = 1;
	
	while($res = mysqli_fetch_array($query)){
	
		if($i != 5) $marge_droite = "mrgD17";
		
		$cheminrubrique = cheminrubrique($res['id_rubrique'],$mysql_link);

		
		$derniere_news .= '<div class="flotG '.$marge_droite.' plusdecontent">';
		$derniere_news .= '<a href="/'.$cheminrubrique.$res["nom_fichier"].'--'.$res["id"].'.html" title="'.$res['titre'].'""><img src="/lib/image/editorial/'.$res['userfile1'].'" alt="'.$res['titre'].'" width="120" height="70" class="mrgB10" /></a><br />';
		$derniere_news .= '<a href="/'.$cheminrubrique.$res["nom_fichier"].'--'.$res["id"].'.html" title="'.$res['titre'].'" class="font12 fontBeigeFonce">'.tronquer($res['titre'],35).'</a><br />';
		$derniere_news .= '</div>';
	
	$marge_droite ='';
	$i++;
	}
	
	$derniere_news .= '</div>';
	
	return $derniere_news;

}

//On affiche les dernières news
function dernierephoto($option1,$valeur1,$option2,$valeur2,$option3,$valeur3,$option4,$valeur4,$mysql_link){

	

	$derniere_news  = '';
	
	$derniere_news .= '<div class="bloc_arrondie mrgT20 mrgB20 bgblack pad10 overflow">';

	$req = "SELECT * FROM m_photo WHERE en_ligne = 1";
	
	if(!empty($option1)){
		$req .= " AND ".$option1."=".$valeur1;
	}
	

	$req .= " ORDER BY rand() LIMIT 0,4";
	$query = mysqli_query($mysql_link,$req);
	
	

	
	$i = 1;
	
	while($res = mysqli_fetch_array($query)){
	
		if($i != 4) $marge_droite = "mrgD20";
		$derniere_news .= '<div class="flotG '.$marge_droite.' plusdephoto alingG">';
		$derniere_news .= '<a href="'.$option4.$res["nom_fichier"].'--'.$res["id"].'-'.$res['id_cat'].'.html" title="'.$res['legende'].'"><img src="/lib/image/photo/'.$res['userfile1'].'" alt="'.$res['legende'].'" width="150" height="100" class="mrgB10 mrgT10" /></a>';
		$derniere_news .= '</div>';
	$marge_droite ='';
	$i++;
	}
	
	$derniere_news .= '</div>';
	
	return $derniere_news;

}



//plus de contenue
function plusdecontenu($titre,$id_content,$table,$mysql_link){

	


	$page = "<p><h3>".stripslashes($titre)."</h3>";
	
	$i = 0;
	$id_news = explode("-",$id_content);
	
	while ($id_news[$i] != ""){
		
		$req_news = "SELECT id, id_rubrique, titre, nom_fichier FROM ".$table." WHERE id=".$id_news[$i];
		$query_news = mysqli_query($mysql_link,$req_news);
		$res_news = mysqli_fetch_array($query_news);
					
		$page .= '<a href="/'.urlFichier($id_news[$i],$res_news['id_rubrique'],$mysql_link).'" title="'.$res_news["titre"].'">'.$res_news["titre"].'</a><br />';
					
		$i++;
	}
	
	$page .= '</p>';
		
	return $page;
}


//plus de photo
function plusdephoto($titre,$id_content,$table,$mysql_link){

	
	
	
	if($titre == "Voir plus de photos"){ $rel = 'rel="nofollow"'; }

	$req_news = "SELECT id_rubrique,id_cat,nom_fichier FROM ".$table." WHERE id=".$id_content;
	$query_news = mysqli_query($mysql_link,$req_news);
	$res_news = mysqli_fetch_array($query_news);
			
	$cheminrubrique = cheminrubrique($res_news["id_rubrique"],$mysql_link);
	
	$page = '<a '.$rel.' href="/galerie-photo/'.$res_news["nom_fichier"].'--'.$id_content.'-'.$res_news["id_cat"].'.html" title="'.$res_news["titre"].'"><strong>'.stripslashes($titre).'</strong></a>';

		
	return $page;
}


//publicite sur les contenus

function plublicite_contenu($option1,$valeur1,$option2,$valeur2,$option3,$valeur3,$mysql_link){

	

	$req_shopping = "SELECT * FROM m_shopping WHERE promotion = 1 ORDER BY rand() DESC LIMIT 0,2";
	$query_shopping = mysqli_query($mysql_link,$req_shopping);
	
	$publicite  = '';
	$publicite .= '<div id="publicite" class="bloc_arrondie">';

	
		
	$i=1;
	while ($res_shopping = mysqli_fetch_array($query_shopping)){ 

	if($i == 1){
		$class_shopping = 'blocPubGauche';
	}else{
		$class_shopping = 'blocPubDroit';
	}


	$publicite .= '<div class="blocPub '.$class_shopping.' flotG fontBlanc font12">';
	$publicite .= '<a href="/'.urlFichier($res_shopping['id'],15,$mysql_link).'" title="'.$res_shopping['titre'].'" rel="nofollow"><img src="/lib/image/shopping/'.$res_shopping['userfile1'].'" width="90" height="90" align="left" class="mrgD10" alt="'.$res_shopping['titre'].'" /></a>';
	$publicite .= '<a href="/'.urlFichier($res_shopping['id'],15,$mysql_link).'" title="'.$res_shopping['titre'].'"><strong class="fontGri font14">'.$res_shopping['titre'].'</strong></a><br />';
	$publicite .= '<span class="font12">'.tronquer($res_shopping['corps'],130)."</span><br />";
	$publicite .= '<a href="/'.urlFichier($res_shopping['id'],15,$mysql_link).'" rel="nofollow"><strong>Cliquez-ici</strong></a>';
	$publicite .= '</div>';
	
	$i++;
	$class_shopping='';
	}
	
	$publicite .= '</div>';

	
	return $publicite;
}

	
//presentation image
function image($fichier,$class_div,$legende,$copyright,$intexte,$rubrique,$nom_lien_photo,$id_plus_photo,$mysql_link){
	
	$image = '';
	
	$image .= '<figure class="'.$class_div.'">';
	$image .= '<img itemprop="image" src="/lib/image/'.$rubrique.'/'.$fichier.'" alt="'.$legende.'" /><br />';
	
	if(!empty($id_plus_photo)){ 
		$image .= plusdephoto("Voir plus de photos",$id_plus_photo,"m_photo",$mysql_link)."<br />"; 
	}
	
	if((!empty($legende)) OR (!empty($copyright))){
		$image .="<figcaption>";
	}
	
	if(!empty($legende)){$image .=  $legende.'<br />';}
	if(!empty($copyright)){$image .=  $copyright.'<br />';}
	
	if((!empty($legende)) OR (!empty($copyright))){
		$image .="</figcaption>";
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
function share($share,$class,$commentaire){

	$share  ="";
	$share .='<div id="share">';
	
	$share .= '<div class="content addthis_toolbox addthis_default_style bloc_arrondie">
			   	<div class="flotG addthis">
					<a class="addthis_button_tweet"></a>
					<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
					<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
					<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4d85b07d533fe1b9"></script>
					<script type="text/javascript" src="http://www.pixrider.com/plugins/js/share.js"></script><script type="text/javascript">share("no","fr","side",window.location.href, encodeURI(document.title));</script>		
				</div>';				
				
	if($commentaire == 1){
		
		$share .='<div class="flotG commentaire">
				  	<div class="bloc_arrondie flotD boutonCommentaire">
						<a href="#commentaire" title="Poster un commentaire" rel="nofollow">Poster un commentaire</a>
					</div>
				  </div>';
	}
				
	$share .=	'</div></div>';


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
	 
	$menu_page .= '<div id="menuPage">';

	
	if  (!empty($res_precedent["nom_fichier"])){
		$menu_page .= '<div class="flotG bouton bloc_arrondie">';
		$menu_page .= '<a title="'.$res_precedent["titre"].'" href="'.$res_precedent["nom_fichier"].'--'.$res_precedent["id"].'-'.$res_precedent["id_sommaire"].'.html"><strong>'.tronquer($res_precedent["titre"],40).'</strong></a>'; 
		$menu_page .= '</div>';
	}
	
	if  (!empty($res_suivant["nom_fichier"])){
		$menu_page .= '<div class="bloc_arrondie flotD bouton">';
		$menu_page .=  '  <a title="'.$res_suivant["titre"].'" href="'.$res_suivant["nom_fichier"].'--'.$res_suivant["id"].'-'.$res_suivant["id_sommaire"].'.html"><strong>'.tronquer($res_suivant["titre"],40).'</strong></a>';
		$menu_page .= '</div>';
	}
	
	$menu_page .= '</div>';
	
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
	
		$menu_page .= '<div id="menuPage">';
	
		//on construit le menu 
		if(!empty($existe_img_apres)){
			$menu_page .= '<div class="flotG bouton bloc_arrondie">';
			$menu_page .= '  <a href="'.$res_img_apres['nom_fichier'].'--'.$res_img_apres['id'].$variable_categorie.$variable_signature.'.html" title="Photo - '.$res_img_apres['legende'].'"><strong>'.tronquer($res_img_apres['legende'],40).'</strong></a> ';
			$menu_page .= '</div>';
		} 
	
		if(!empty($existe_img_avant)){
			$menu_page .= '<div class="bloc_arrondie flotD bouton">';
			$menu_page .= '<a href="'.$res_img_avant['nom_fichier'].'--'.$res_img_avant['id'].$variable_categorie.$variable_signature.'.html" title="Photo - '.$res_img_avant['legende'].'"><strong>'.tronquer($res_img_avant['legende'],40).'</strong></a>';
			$menu_page .= '</div>';
		} 
	
		$menu_page .= '</div>';
	
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
	
	$ariane = '<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" id="ariane" class="mrgB20">Vous êtes : ';
	
	
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
		
		$listing .= '<div class="overflow alingL font13 clearB pad20 mrgT10 bloc_arrondie bgArticleUne">';
		$listing .= '<a href="'.$nom_fichier.'--'.$id.'.html" title="'.$titre.'" rel="nofollow"><img width="318" height="162" class="mrgD10" src="'.$image_gd.'" alt="'.$titre.'" align="left" /></a>';
		
		if($date_pubication != "0000-00-00"){
			$listing .= '<strong class="fontBlanc">'.dateformat($date_pubication,"en","fr").'</strong>';
		}
		
		
		$listing .= '<h2><a href="'.$nom_fichier.'--'.$id.'.html" title="'.$titre.'" class="font17 fontBlanc">'.$titre.'</a></h2>';
		$listing .= '<span class="fontBlanc">'.$chapeau.'</span>';	

		$listing .= '</div>';
		
		/************************************* Pour réaliser le bloc a la une *************************************/
	
	}else{
		
		$idRubrique = idRubrique($id,"m_editorial",$mysql_link);
		$url = urlFichier($id,$idRubrique,$mysql_link);
		
		if($i%2 == 1)$classimpaire = "bggrisclair";
	
			$listing .= '<div class="overflow alingJ font13 clearB pad10 mrgT10 bloc_arrondie '.$classimpaire.'">';
	
			if((file_exists($vignette)) AND (!empty($vignette))){
				$listing .= '<a href="/'.$url.'" title="'.$titre.'" rel="nofollow"><img width="'.$width.'" height="'.$height.'" class="mrgD10" src="'.$vignette.'" alt="'.$titre.'" align="left" /></a>';
			}

			$listing .= '<a href="/'.$url.'" title="'.$titre.'"><h2 class="listing">'.$titre.'</h2></a>';

			$listing .= tronquer($chapeau,170);	
			
			if((!empty($date_pubication)) AND ($date_pubication != "0000-00-00")){
				$listing .= '<br /><strong class="fontBeigeFonce font11">Publié le '.dateformat($date_pubication,"en","fr")."</strong>";
			}

	
			
	
		$listing .= '</div>';
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
	
	$mrgd20 = "";
	
	
	//Bloc 2 shopping avec texte
	if(($i ==1) OR ($i==8) OR ($i==15)) {
		$listing .= '<div class="clearB">';
		$listing .= '<div class="listeshopping mrgD20 flotG bloc_arrondie bggrisclair">';
		$listing .= '<a href="'.$path_shopping.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'" rel="nofollow"><img width="148" height="148" class="mrgD10" src="'.$path_shopping.'../lib/image/shopping/'.$res["userfile3"].'" alt="'.$res['titre'].'" align="left" /></a>';
		$listing .= '<a href="'.$path_shopping.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'"><h2 class="listing">'.tronquer($res['titre'],75).'</h2></a>';
		$listing .= tronquer($res['corps'],100);
		$listing .= '</div>';

	}elseif(($i==2) OR ($i==9) OR ($i==16)) {
		$listing .= '<div class="listeshopping bloc_arrondie bggrisfonce">';
		$listing .= '<a href="'.$path_shopping.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'" rel="nofollow"><img width="148" height="148" class="mrgD10" src="'.$path_shopping.'../lib/image/shopping/'.$res["userfile3"].'" alt="'.$res['titre'].'" align="left" /></a>';
		$listing .= '<a href="'.$path_shopping.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'"><h2 class="listing">'.tronquer($res['titre'],75).'</h2></a>';
		$listing .= tronquer($res['corps'],100);
		$listing .= '</div>';
	}
	
	if(($i==2) OR ($i==9) OR ($i==16)){
		$listing .= '</div>';
	}
	
	
	
	//Bloc 5 shopping
	if(($i==3) OR ($i==10)){
		$listing .= '<div class="overflow bloc_arrondie bgblack clearB mrgB20 pad20">';
	}
	
	if(((3 <= $i) AND (7 >= $i)) OR ((10 <= $i) AND (14 >= $i))){
		
		if(($i!=7) AND ($i!=14)) $mrgd20="mrgD19";
		
		$listing .= '<a href="'.$path_shopping.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'"><img width="114" height="114" class="'.$mrgd20.' imgNoBorder" src="'.$path_shopping.'../lib/image/shopping/'.$res["userfile1"].'" alt="'.$res['titre'].'" align="left" /></a>';
	}

	if(($i==7) OR ($i==14) OR (($nbr_shopping == $i) AND (($i<7) OR ($i<14)))){
		$listing .= '</div>';
	}
		
	return $listing;
	
}


//listing agenda
function listing_agenda($id,$i,$mois,$mysql_link){


	//on rérupère les donnees
	$res = donnee("m_agenda","id",$id,"","",$mysql_link);
	
	$classimpaire = "";
	$mrgdroite = "";
	

	if($i%2 != 1)$classimpaire = "bggrisclair"; else $classimpaire = "bggrisfonce";
	if($i%3 != 2)$mrgdroite = "mrgD20";
	



	if(!empty($mois)){
	
		$listing .= '<div class="overflow alingL font13 mrgB20 '.$mrgdroite.' bloc_arrondie agenda flotG '.$classimpaire.'">';
		$listing .= '<div class="alignC mrgT30"><strong class="bgBeigeFonce bloc_arrondie fontBlanc pad10 font14">'.$mois.'</strong></div>';
		$listing .= '</div>';
		
	}else{
		
		$listing .= '<div class="overflow alingL font13 mrgB20 '.$mrgdroite.' bloc_arrondie agenda flotG '.$classimpaire.'">';
		$listing .= '<span class="bgvert fontBlanc pad3 font12">'.dateformat($res["date_debut"],"en","fr").'</span>';
		$listing .= '<div class="mrgT10"><a href="'.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'" class="fontBold font13">'.$res['titre'].'</a> - <span class="font11 fontGriClair">'.$res['lieu'].'</span></div>';
		$listing .= '</div>';
	}
		
	

	
	
	return $listing;
	
}


//listing lexique
function listing_lexique($id,$i,$nbr_lexique,$mysql_link){


	//on rérupère les donnees
	$res = donnee("m_tag","id",$id,"","",$mysql_link);
	
	$classimpaire = "";
	$mrgdroite = "";

	if($i%2 != 1)$classimpaire = "bggrisclair"; else $classimpaire = "bggrisfonce";
	if($i%3 != 2)$mrgdroite = "mrgD20";
	
	if(($i==0) OR ($i==3) OR ($i==6) OR ($i==9) OR ($i==12) OR ($i==15)) {
		$listing .= '<div class="clearB">';
	}
	
	$listing .= '<div class="alingL mrgB20 '.$mrgdroite.' bloc_arrondie lexique flotG '.$classimpaire.'">';
	$listing .= '<div class="bgrose fontBlanc pad3 font12 mrgB5"><h2><span class="fontBlanc">&nbsp;'.$res['nom'].'</span></h2></div><span class="font12 fontGriClair">'.tronquer($res['corps'],200).' [...]</span>';
	$listing .= '<div class="mrgT5"><a href="../tag/'.$res['nom_fichier'].'--'.$res['id'].'.html" title="Consulter la définition de '.$res['nom'].'" class="font12">Définition : '.$res['nom'].'</a></div>';
	$listing .= '</div>';
	
	//echo $nbr_lexique."==".$i;
	
	if(($i%3 == 2) OR ($nbr_lexique == ($i+1))){
		$listing .= '</div>';
	}
	
	return $listing;
	
}



//listing annuaire
function listing_annuaire($id,$i,$nbr_annuaire,$mysql_link){
	
	
	

	//on rérupère les donnees
	$res = donnee("m_annuaire","id",$id,"","",$mysql_link);
	
	$classimpaire = "";

	
	if($i%2 != 1){
		$classimpaire = "demiG"; 
		$listing .= '<div class="overflow clearB mrgT10">';
	}else{
		$classimpaire = "demiD";
	} 
	
	
	if((empty($i)) OR ($i==3) OR ($i==4) OR ($i==7) OR ($i==8) OR ($i==11) OR ($i==12) OR ($i==15) OR ($i==16)) $color_fond = "bggrisclair";
	else $color_fond = "bggrisfonce";
	
			
	$listing .= '<div class="overflow bloc_arrondie '.$classimpaire.' '.$color_fond.'">';
	$listing .= '<a href="'.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'" rel="nofollow"><img width="90" height="90" class="mrgD10" src="../lib/image/annuaire/'.$res["userfile1"].'" alt="'.$res['titre'].'" align="left" /></a>';
	$listing .= '<a href="'.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'"><h2 class="listing">'.tronquer($res['titre'],75).'</h2></a>';
	$listing .= '<span class="font12">'.tronquer($res['corps'],100).'</span><br />';	
	$listing .= '<strong class="font12">'.region($res['id_region']).pays($res['id_pays']).'</strong>';
	$listing .= '</div>';
	
	if(($i%2 == 1) OR ($nbr_annuaire == ($i+1))){
		$listing .= '</div>';
	}
	
	return $listing;
	
}


//listing annonce
function listing_annonce($id,$i,$nbr_annuaire,$mysql_link){
	
	
	

	//on rérupère les donnees
	$res = donnee("m_editorial","id",$id,"","",$mysql_link);
	
	$classimpaire = "";

	
	if($i%2 != 1){
		$classimpaire = "demiG"; 
		$listing .= '<div class="overflow clearB mrgT10">';
	}else{
		$classimpaire = "demiD";
	} 
	
	
	if((empty($i)) OR ($i==3) OR ($i==4) OR ($i==7) OR ($i==8) OR ($i==11) OR ($i==12) OR ($i==15)) $color_fond = "bggrisclair";
	else $color_fond = "bggrisfonce";
	
			
	$listing .= '<div class="overflow bloc_arrondie '.$classimpaire.' '.$color_fond.'">';
	
	if(!empty($res["userfile1"])){
		$listing .= '<a href="'.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'" rel="nofollow"><img width="90" height="90" class="mrgD10" src="../lib/image/editorial/'.$res["userfile1"].'" alt="'.$res['titre'].'" align="left" /></a>';
	}else{
	
		$req_img = "SELECT image FROM m_cat WHERE id=".$res['id_cat'];
		$query_img = mysqli_query($mysql_link,$req_img);
		$res_img = mysqli_fetch_array($query_img);
		$listing .= '<a href="'.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'" rel="nofollow"><img width="90" height="90" class="mrgD10" src="../lib/image/template/'.$res_img["image"].'" alt="'.$res['titre'].'" align="left" /></a>';

	}
	$listing .= '<strong>'.categorie($res['id_cat']).'</strong><br /><a href="'.$res['nom_fichier'].'--'.$res['id'].'.html" title="'.$res['titre'].'"><h2 class="listing">'.tronquer($res['titre'],75).'</h2></a>';
	$listing .= '<span class="font12">'.tronquer($res['corps'],100).'</span><br />';	
	$listing .= '</div>';
	
	if(($i%2 == 1) OR ($nbr_annuaire == ($i+1))){
		$listing .= '</div>';
	}
	
	return $listing;
	
}






//listing galerie photo
function listing_photo($id,$i,$id_photographe,$width,$height,$listing_photographe,$nbr_photo,$mysql_link){
	
	
	

	$classimpaire = "";

	
	if($i%2 != 1){
		$classimpaire = "demiG"; 
		$listing .= '<div class="overflow clearB mrgT10">';
	}else{
		$classimpaire = "demiD";
	} 
	
	if(!empty($id_photographe)){
		$id_photographe = "-".$id_photographe;
		$path_image = "../";
	}
	
	
	if((empty($i)) OR ($i==3) OR ($i==4) OR ($i==7) OR ($i==8) OR ($i==11) OR ($i==12) OR ($i==15) OR ($i==16)OR ($i==19)) $color_fond = "bggrisclair";
	else $color_fond = "bggrisfonce";
	
			
	$listing .= '<div class="overflow bloc_arrondie '.$classimpaire.' '.$color_fond.'">';
	
	if($listing_photographe == 1){
		
		//on rérupère les donnees des photographes
		$res = donnee("m_tag","id",$id,"","",$mysql_link);

		$listing .= '<a href="/galerie-photo/photographe/'.recupere_url_signature($res['id'],$mysql_link).'-'.$res['id'].'-1.html" title="'.$res['nom'].'" rel="nofollow"><img width="'.$width.'" height="'.$height.'" class="mrgD10" src="../../lib/image/photo/photographe/'.$res['userfile1'].'" alt="'.$res['nom'].'" align="left" /></a>';
		$listing .= '<h2 class="listing">'.$res['nom'].'</h2>';
		$listing .= '<span class="font12">Découvrez les plus belles photos du photographe '.$res['nom'].'</span><br /><br />';
		$listing .= '<a href="/galerie-photo/photographe/'.recupere_url_signature($res['id'],$mysql_link).'-'.$res['id'].'-1.html" title="'.$res['nom'].'" class="font12">Voir les photos de '.$res['nom'].'</a>';

	}else{
	
		//on rérupère les donnees des photos
		$res = donnee("m_photo","id",$id,"","",$mysql_link);

		$listing .= '<a href="/galerie-photo/'.$res['nom_fichier'].'--'.$res['id'].'-'.$res['id_cat'].$id_photographe.'.html" title="'.$res['legende'].'" rel="nofollow"><img width="'.$width.'" height="'.$height.'" class="mrgD10" src="'.$path_image.'../lib/image/photo/'.$res["userfile1"].'" alt="'.$res['legende'].'" align="left" /></a>';
		$listing .= '<a href="/galerie-photo/'.$res['nom_fichier'].'--'.$res['id'].'-'.$res['id_cat'].$id_photographe.'.html" title="'.$res['legende'].'"><h2 class="listing">'.tronquer($res['legende'],75).'</h2></a>';
	
		if(!empty($res['copyright'])){
			$listing .= '© '.$res['copyright'];
		}else{
			$listing .= '© '.recupere_signature($res['id_photographe'],"1",$mysql_link);
		}
	}
	
	
				
	$listing .= '</div>';
	
	if(($i%2 == 1) OR ($nbr_photo == ($i+1))){
		$listing .= '</div>';
	}
	
	return $listing;
	
}




//listing galerie photo Admin
function listing_photo_admin($id,$i,$id_photographe,$width,$height,$mot_cle,$identifiant,$id_cat,$id_photographe,$nbr_photo,$mysql_link){
	
	
	

	$classimpaire = "";

	
	if($i%2 != 1){
		$classimpaire = "demiG"; 
		$listing .= '<div class="overflow clearB mrgT10">';
	}else{
		$classimpaire = "demiD";
	} 
	
	
	if((empty($i)) OR ($i==3) OR ($i==4) OR ($i==7) OR ($i==8) OR ($i==11) OR ($i==12) OR ($i==15) OR ($i==16) OR ($i==19) OR ($i==20) OR ($i==23) OR ($i==24) OR ($i==27) OR ($i==28)) $color_fond = "bggrisclair";
	else $color_fond = "bggrisfonce";
	
			
	$listing .= '<div class="overflow bloc_arrondie '.$classimpaire.' '.$color_fond.'">';
	
		
	//on rérupère les donnees des photos
	$res = donnee("m_photo","id",$id,"","",$mysql_link);

	$listing .= '<a href="/galerie-photo/'.$res['nom_fichier'].'--'.$res['id'].'-'.$res['id_cat'].$id_photographe.'.html" title="'.$res['legende'].'" rel="nofollow"><img width="'.$width.'" height="'.$height.'" class="mrgD10" src="../../lib/image/photo/'.$res["userfile1"].'" alt="'.$res['legende'].'" align="left" /></a>';
	$listing .= '<div style="height:45px;">'.tronquer($res['legende'],60).'</div>';
	$listing .= '<br />';
	$listing .= '<a target="_blank" href="/galerie-photo/'.$res['nom_fichier'].'--'.$res['id'].'-'.$res['id_cat'].$id_photographe.'.html" title="'.$res['legende'].'" rel="nofollow"><img src="/lib/image/template/a-voir.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" alt="voir" /></a>';
	$listing .= '<a href="ajout.php?id='.$res['id'].'&id_rubrique='.$res['id_rubrique'].'" title="Modifier"><img src="/lib/image/template/a-modifier.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" alt="modifier" /></a>';
	$listing .= '<a onClick="if (confirm(\'Etes vous certain de vouloir suprimer ! \')) document.location.href=\'index.php?supp=1&id='.$res["id"].'&id_rubrique='.$res['id_rubrique'].'&identifiant='.$identifiant.'&mot_cle='.$mot_cle.'&id_cat='.$id_cat.'&id_photographe='.$id_photographe.'\'; else return false;" href="#"><img src="/lib/image/template/a-supprimer.png" alt="supprimer" class="ImgNoBorder" height="20" width="20" valign="middle" /></a>';




	$listing .= '</div>';
	
	if(($i%2 == 1) OR ($nbr_photo == ($i+1))){
		$listing .= '</div>';
	}
	
	return $listing;
	
}




//listing marque de surf
function listing_marque($id,$i,$width,$height,$nbr_marque,$mysql_link){
	
	
	

	$classimpaire = "";

	
	if($i%2 != 1){
		$classimpaire = "demiG"; 
		$listing .= '<div class="overflow clearB mrgT10">';
	}else{
		$classimpaire = "demiD";
	} 
	
	
	if((empty($i)) OR ($i==3) OR ($i==4) OR ($i==7) OR ($i==8) OR ($i==11) OR ($i==12) OR ($i==15) OR ($i==16) OR ($i==19)) $color_fond = "bggrisclair";
	else $color_fond = "bggrisfonce";
	
			
	$listing .= '<div class="overflow bloc_arrondie '.$classimpaire.' '.$color_fond.'">';
	
		
	//on rérupère les donnees des photographes
	$res = donnee("m_tag","id",$id,"","",$mysql_link);

	$listing .= '<a href="/shopping/marque/'.$res['nom_fichier'].'-'.$res['id'].'-1.html" title="'.$res['nom'].'" rel="nofollow"><img width="'.$width.'" height="'.$height.'" class="mrgD10" src="/lib/image/shopping/marque/'.$res['userfile1'].'" alt="'.$res['nom'].'" align="left" /></a>';
	$listing .= '<a href="/shopping/marque/'.$res['nom_fichier'].'-'.$res['id'].'-1.html" title="'.$res['nom'].'"><h2 class="listing">'.$res['nom'].'</h2></a>';
	$listing .= '<span class="font12">Découvrez les produits de la marque '.$res['nom'].'</span><br /><br />';
	$listing .= '<a href="/shopping/marque/'.$res['nom_fichier'].'-'.$res['id'].'-1.html" title="'.$res['nom'].'" class="font12" rel="nofollow">Voir '.$res['nom'].'</a>';
				
	$listing .= '</div>';
	
	if(($i%2 == 1 OR ($nbr_marque == ($i+1)))){
		$listing .= '</div>';
	}
	
	return $listing;
	
}




// Gestion des commentaire
function genere_commentaire($id_rubrique,$id_contenu,$ajout,$nom,$commentaire,$nom_fichier,$p,$ancre,$s,$link,$mysql_link) { 


	
	require("f-pager.php");
	require("f-formulaire.php");

	
?>

<div id="commentaire" name="commentaire" class="bggrisclair bloc_arrondie mrgT20 mrgB20 overflow pad10">

	<?php if((empty($link)) AND (!empty($ajout)) AND (!empty($commentaire)) AND (!empty($nom))){ 
	//Insert un nouveau commentaire
	
	$req_insert  = "INSERT INTO m_commentaire SET ";
	$req_insert .= "id_rubrique =\"".$id_rubrique."\" ";	
	
	$req_insert .= ",id_contenu = \"".$id_contenu."\" ";
	$req_insert .= ",nom =\"".strip_tags(stripslashes($nom))."\" ";
	$req_insert .= ",corps =\"".strip_tags(stripslashes($commentaire))."\" ";
	$req_insert .= ",etat = 0";
	$query_insert = mysqli_query($mysql_link,$req_insert);
	$last_id = (last_id("m_commentaire")-1);
	
	
	echo '<div class="alerte alignC pad10">Votre message a bien été enregistré !<br />Votre commentaire sera validé très rapidement</div>';
	
	$message =  'Nouveau commentaire<br /><br />';
	$message .= 'Nom : '.strip_tags($nom).'<br />';
	$message .= 'Commentaire : '.strip_tags($commentaire).'<br /><br />';
	$message .= 'Modifier  : http://www.mango-surf.com/admin/commentaire/ajout.php?id='.$last_id.'<br />';
	$message .= 'Supprimer  : http://www.mango-surf.com/admin/commentaire/index.php?supp=1&etat=1&id='.$last_id.'<br />';

	
	$headers = 'Content-type: text/html; charset=utf-8' . "\r\n";
	
	mail('romain@mango-surf.com', '[Mango-Surf.com] - Nouveau commentaire', $message,$headers);
	
	}else{ 

	?>

		
		<h4 class="fontBeigeFonce">Participez aux débats ! Publiez un commentaire</h4><br />
		
		<div class="flotG mrgD20">	
			<form method="POST" action="<?php echo $nom_fichier; ?>--<?php echo $id_contenu; ?><?php if($id_rubrique == 17){ echo "-".id_cat_photo($id_contenu); } ?><?php if(($id_rubrique == 17) AND (!empty($s))){ echo '-'.$s; }  ?><?php if(($id_rubrique == 4) OR ($id_rubrique == 6)){ echo '-'.idsommaire($id_contenu); } ?>.html#commentaire" name="commentaire" id="commentaire" onsubmit="return valid();">
			<?php 
			
			if(($id_rubrique == 7) OR ($id_rubrique == 6)){
				require("../../lib/formulaire/form-commentaire.php"); 
			}else{
				require("../lib/formulaire/form-commentaire.php"); 
			}	
			?>
			</form>
		</div>
		<div class="flotG bgblanc bloc_arrondie regle mrgB20">
		<strong>Règle de publication</strong><br /><br />
		Avant de poster un commentaire merci de respecter les quelques règles ci-dessous.
		<br /><br />
		1 - Pas d'insulte dans les commentaires<br />
		2 - Ne pas intégrer de code HTML<br />
		
		<?php
		if((!empty($ajout)) AND (empty($nom))){
			echo '<span class="fontrouge fontBold">3 - Vous avez oublié de saisir votre nom !</span><br />';
		}else{
			echo '3 - Indiquer votre nom ou pseudo<br />';
		}
		
		if((!empty($ajout)) AND (empty($commentaire))){
			echo '<span class="fontrouge fontBold">4 - Vous avez oublié de saisir votre commentaire</span>';
		}else{
			echo '4 - Et puis, commentez !';
		}

		?>
		
		
		
		
		</div>
		
		
		<?php } ?>
		
		
		<?php
		
		//initialisation pager
		if ((empty($_GET['p'])) || ($_GET['p'] == 0)) $p = 1; else $p = $_GET['p'];
		$par_page = 8;
		
		$req =  "SELECT * FROM m_commentaire WHERE id_rubrique = ".$id_rubrique." AND id_contenu = ".$id_contenu." AND etat = 1 ORDER BY id DESC LIMIT ".(($p-1)*$par_page).",".$par_page;
		$query = mysqli_query($mysql_link,$req);
		
		
		
		$exist = nbrcontent("m_commentaire","id_rubrique",$id_rubrique,"id_contenu",$id_contenu," AND etat = 1",$mysql_link);
		
		
		if (!empty($exist)){
			
			echo '<div class="clearB">';
		
			$i = "";
			
			while ($res = mysqli_fetch_array($query)){ 
			
			if($i%2 != 1){
				$classimpaire = "bgblanc"; 
			}else{
				$classimpaire = "bggrisfonce";
			} 
			
			
		
		?>
		<div class="overflow bloc_arrondie alingJ font13 clearB pad10 mrgT10 <?php echo $classimpaire; ?>">
			<strong><?php echo $res['nom'];?></strong><br />
			<?php echo $res['corps'];?>
		</div>	
			
			
		<?php $i++; }
		
		echo '</div>';
		
		if($id_rubrique == 17){
			$variable_pager = id_cat_photo($id_contenu,$mysql_link);
		}
		
		
		if(!empty($s)){
			$variable_pager .= '-'.$s;
		}
		
		if(!empty($ancre)){
			$variable_pager .= $ancre;
		}
		
		
		echo $pager = pager_rewriting($exist,$par_page,$p,$nom_fichier."-",$id_contenu,"#commentaire",$variable_pager); 
		
		}


		
		?>


</div>

<?php } ?>





