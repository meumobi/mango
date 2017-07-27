<?php 
$rubrique = 14;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/f-formulaire.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/f-upload-fichier.php");
require("../lib/fonction/f-nom-fichier.php");
require("../lib/fonction/f-recadre-photo.php");

$no_sky = 1;
$no_photo = 1;

if(($_POST['a'] == 1) AND (empty($_POST['link']))){

	if(!empty($_POST['id'])) {
		$action_requette = "UPDATE";
		$last_id = $_POST['id'];			
	}else{
		$action_requette = "INSERT INTO";
		$last_id = last_id("m_annuaire",$mysql_link);
	}	
	
	// on prépare le nom du fichier
	$nom_fichier = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))); 
	
	// on prépare le nom des images
	$nom_fichier_image[2] = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))).'-'.$last_id;
	
	$req = $action_requette." m_annuaire SET ";
	
	$req .= "id =\"".$last_id."\" ";
	$req .= ",id_rubrique =\"".$_POST['id_rubrique']."\" ";
	$req .= ",id_pays =\"".$_POST['id_pays']."\" ";
	$req .= ",id_region =\"".$_POST['id_region']."\" ";
	$req .= ",id_cat =\"".$_POST['id_cat']."\" ";
	$req .= ",titre  =\"".addslashes(strip_tags($_POST['titre']))."\" ";
	$req .= ",corps  =\"".addslashes(strip_tags($_POST['corps']))."\" ";
	
// on upload les images + test

	$i = 2;
	
	if(!empty($_FILES['userfile'.$i]['name'])){
	
		$taille = getimagesize($_FILES['userfile'.$i]['tmp_name']); 
		$h = $taille[1]; 
		$w = $taille[0]; 
		$poid = $_FILES['userfile'.$i]['size'];

		if (($h<=800) AND ($w<=800) AND ($poid<=800000)){
	
			$fichier_image = upload_fichier("m_annuaire",$_FILES['userfile'.$i]['type'],"www/lib/image/annuaire/",$nom_fichier_image[$i],$i,$supprimer_image,$last_id);
			
			
			$thumb = new Image("../lib/image/annuaire/".$fichier_image);
			$thumb->crop = false;
			$thumb->width(265);
			$thumb->save();
			
			
			$req .= ",userfile".$i."  =\"".$fichier_image."\" ";
		}

	
	}
	

	//fin upload
		
	$req .= ",adresse  =\"".strip_tags($_POST["adresse"])."\" ";
	$req .= ",cp  =\"".strip_tags($_POST["cp"])."\" ";
	$req .= ",ville  =\"".addslashes(strip_tags($_POST["ville"]))."\" ";
	$req .= ",email  =\"".strip_tags($_POST["email"])."\" ";
	$req .= ",telephone  =\"".strip_tags($_POST["telephone"])."\" ";
	$req .= ",url_lien  =\"".strip_tags($_POST['url_lien'])."\" ";
	$req .= ",nom_fichier  =\"".$nom_fichier."\" ";
	$req .= ",en_ligne  = 2";
	
	
	if(!empty($_POST['id'])) $req .= " WHERE id=".$_POST['id'];
	
	$query = mysqli_query($mysql_link,$req);
	
	//on rérupère les donnees
	$res = donnee("m_annuaire","id",$last_id,"","",$mysql_link);
	
}

?>



<?php require("../lib/include/n_i-meta.php"); ?>	

<title>Visualisation</title>	
<meta name="robots" content="noindex">
		
</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">


	<?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1"><?php echo rubrique(14,$mysql_link); ?></div>
			<div class="line">

			<a href="/video/where-is-sancho-nias--4474.html"><div class="bouton txtcenter mt2 mb2">Merci d'avoir ajouté votre entreprise. Une petite surprise si tu cliques !</div></a>

			
			<h1><?php echo stripslashes($res['titre']); ?></h1>
			
				<div class="big">

				
				<?php if(!empty($res['userfile2'])) echo $image = image($res['userfile2'],"flotD alingG mrgG10","","","","annuaire","",""); ?>
				
				<p><?php if(!empty($res['corps']))echo stripslashes(nl2br($res['corps'])); ?></p>
				
				</div>
				
				
				
				
				<div class="alingJ clearB mrgT10">
				<strong>Informations contact</strong><br />
				<?php if(!empty($res['adresse'])){ echo stripslashes($res['adresse']).'<br />'; } ?>
				<?php if(!empty($res['cp'])){ echo stripslashes($res['cp']).' - '; } ?>
				<?php if(!empty($res['ville'])){ echo stripslashes($res['ville']).'<br />'; } ?>
				<?php if(!empty($res['telephone'])){ echo stripslashes($res['telephone']).'<br />'; } ?>
				<?php if(!empty($res['email'])){ echo stripslashes($res['email']).'<br />'; } ?>
				<?php if(!empty($res['url_lien'])){ echo '<a href="'.$res['url_lien'].'">cliquez ici</a><br />'; } ?>
				<br /><br />
				</div>
				
				</div>
			
				
			
			</div>
			
		</div>
			
	<?php require("../lib/include/n_i-footer.php") ?>	
	

</div>
</body>

</html>