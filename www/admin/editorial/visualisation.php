<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/f-formulaire.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/f-upload-fichier.php");
require("../../lib/fonction/f-nom-fichier.php");
require("../../lib/fonction/f-recadre-photo.php");

if($_POST['a'] == 1){

	if(!empty($_POST['id'])) {
		$action_requette = "UPDATE";
		$last_id = $_POST['id'];
		$date_modification = dateformat("","en","en");
		$date_publication = dateformat($_POST["date_publication"],"fr","en");


	}else{
		$action_requette = "INSERT INTO";
		$last_id = last_id("m_editorial",$mysql_link);

		$date_publication = dateformat($_POST["date_publication"],"fr","en");
		$date_modification = dateformat("","en","en");

		$message =  'Coucou Biloute<br /><br />';
		$message .= 'J\'ai publié un nouvel article sur mango ! On va faire péter les statistiques :<br /> '.strip_tags($_POST['titre']).'<br />';
		$message .= 'Voici l\'Url  : http://www.mango-surf.com/admin/editorial/ajout.php?id='.$last_id.'&id_rubrique='.$_POST['id_rubrique'].'<br /><br />';
		$message .= 'Si tu peux cocher vérifier, ca me permet de voir que c\'est bon !<br /><br />';
		$message .=  'I Love You...<br /><br />';


		$headers = 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From:romain@mango-surf.com';

		//mail('emiliedalibert@hotmail.com', 'Youpi !', $message,$headers);
	}






	
	if($_POST['en_ligne'] == 1){
		$en_ligne = 1;
	}else{
		$en_ligne = 2;
	}
	
	// on prépare le nom du fichier
	$nom_fichier = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))); 
	
	// on prépare le nom des images
	$nom_fichier_image[1] = prepare_url(filtre_url(nom_fichier_define($_POST['legende3']))).'-'.$last_id;
	$nom_fichier_image[2] = prepare_url(filtre_url(nom_fichier_define($_POST['legende3']))).'-'.$last_id;
	$nom_fichier_image[3] = prepare_url(filtre_url(nom_fichier_define($_POST['legende3']))).'-'.$last_id;
	$nom_fichier_image[4] = prepare_url(filtre_url(nom_fichier_define($_POST['legende4']))).'-'.$last_id;
	
	if($_POST['id_rubrique'] == 9){
		$nom_fichier_image[2] = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))).'-'.$last_id;
	}


	$req = $action_requette." m_editorial SET ";
	
	$req .= "id =\"".$last_id."\" ";
	$req .= ",id_rubrique =\"".$_POST['id_rubrique']."\" ";
	$req .= ",id_cat =\"".$_POST['id_cat']."\" ";
	$req .= ",id_pays =\"".$_POST['id_pays']."\" ";
	$req .= ",id_region =\"".$_POST['id_region']."\" ";
	$req .= ",id_sommaire =\"".$_POST['id_sommaire']."\" ";
	$req .= ",id_emplacement =\"".$_POST['id_emplacement']."\" ";
	$req .= ",id_tag =\"".$_POST['id_tag']."\" ";
	$req .= ",id_produit =\"".$_POST['id_produit']."\" ";
	$req .= ",id_publicite =\"".$_POST['id_publicite']."\" ";
	$req .= ",date_publication =\"".$date_publication."\" ";
	$req .= ",date_modification =\"".$date_modification."\" ";
	$req .= ",titre  =\"".addslashes($_POST['titre'])."\" ";
	$req .= ",chapeau  =\"".addslashes($_POST['chapeau'])."\" ";
	
	if($_POST['id_rubrique'] == 9){
	 	$req .= ",corps  =\"".addslashes($_POST['corps'])."\" ";
	}else{
		$req .= ",corps  =\"".addslashes($_POST['corps'])."\" ";
	}
	
	
	$req .= ",auteur  =\"".addslashes($_POST['auteur'])."\" ";
	$req .= ",email  =\"".$_POST['email']."\" ";
	$req .= ",spot  =\"".addslashes($_POST['spot'])."\" ";
	$req .= ",prix  =\"".$_POST['prix']."\" ";
	$req .= ",nom_lien  =\"".addslashes($_POST['nom_lien'])."\" ";
	$req .= ",url_lien  =\"".$_POST['url_lien']."\" ";
	$req .= ",video_article  =\"".addslashes($_POST['video_article'])."\" ";
	$req .= ",titre_video  =\"".addslashes($_POST['titre_video'])."\" ";
	$req .= ",id_video  =\"".$_POST['id_video']."\" ";
	$req .= ",titre_news  =\"".addslashes($_POST['titre_news'])."\" ";
	$req .= ",id_news  =\"".$_POST['id_news']."\" ";

    $req .= ",id_objet_rubrique  =\"".addslashes($_POST['id_objet_rubrique'])."\" ";
    $req .= ",id_content_objets  =\"".$_POST['id_content_objets']."\" ";
    $req .= ",diaporama =\"".$_POST['diaporama']."\" ";
    $req .= ",titre_photo  =\"".addslashes($_POST['titre_photo'])."\" ";
	$req .= ",id_photo  =\"".$_POST['id_photo']."\" ";
	
	

	
	if(!empty($_FILES['userfile2']['name'])){
	

		// on copie l'image sur le serveur
		$fichier_image_une = upload_fichier("m_editorial",$_FILES['userfile2']['type'],"www/lib/image/editorial/",$nom_fichier_image[2],"2",$supprimer_image,$last_id);
		
		
		//on copie l'image en 320x160
		$nom_fichier_image_320_160 = "320x160-".$fichier_image_une;
		copy("../../lib/image/editorial/".$fichier_image_une,"../../lib/image/editorial/".$nom_fichier_image_320_160);

		$thumb = new Image("../../lib/image/editorial/".$nom_fichier_image_320_160);
		$thumb->crop = false;
		$thumb->width(320);
		$thumb->height(160);
		$thumb->save();

	
		//on copie l'image pour l'iphone
		copy("../../lib/image/editorial/".$fichier_image_une,"../../lib/image/editorial/iphone/".$fichier_image_une);

		$thumb = new Image("../../lib/image/editorial/iphone/".$fichier_image_une);
		$thumb->crop = false;
		$thumb->width(320);
		$thumb->height(160);
		$thumb->save();

			
		// on prepare la petite image
		$nom_fichier_image1 = "pt-".$fichier_image_une;
		copy("../../lib/image/editorial/".$fichier_image_une,"../../lib/image/editorial/".$nom_fichier_image1);
		
		$dimention_image = getimagesize("../../lib/image/editorial/".$nom_fichier_image1);

		$thumb = new Image("../../lib/image/editorial/".$nom_fichier_image1);
		$thumb->height(70);
		$thumb->save();
		
		$thumb = new Image("../../lib/image/editorial/".$nom_fichier_image1);
		$thumb->crop = true;
		$thumb->width(120);
		$thumb->height(70);
		$thumb->save();
		
		// On integre le nom de l'image en bdd
		$req .= ",userfile0 =\"".$fichier_image_une."\" ";
		$req .= ",userfile1 =\"".$nom_fichier_image1."\" ";
		$req .= ",userfile2 =\"".$nom_fichier_image_320_160."\" ";
		$req .= ",userfile3 =\"".$fichier_image_une."\" ";
	}
	
	$req .= ",legende3  =\"".$_POST["legende3"]."\" ";
	$req .= ",copyright3  =\"".$_POST["copyright3"]."\" ";

	
	if(!empty($_FILES['userfile4']['name'])){
		$fichier_image = upload_fichier("m_editorial",$_FILES['userfile4']['type'],"www/lib/image/editorial/",$nom_fichier_image[4],"4",$supprimer_image,$last_id);
		
		$req .= ",userfile4 =\"".$fichier_image."\" ";
	}
	
	$req .= ",legende4  =\"".$_POST["legende4"]."\" ";
	$req .= ",copyright4  =\"".$_POST["copyright4"]."\" ";

	

	
	$req .= ",lien_video_iphone  =\"".$_POST["lien_video_iphone"]."\" ";
	$req .= ",no_iphone  =\"".$_POST["no_iphone"]."\" ";
	$req .= ",diapo_news  =\"".$_POST["diapo_news"]."\" ";
	$req .= ",en_ligne  =\"".$en_ligne."\" ";
	$req .= ",classement  =\"".$_POST["classement"]."\" ";
	$req .= ",nom_fichier  =\"".$nom_fichier."\" ";
	$req .= ",verifie  =\"".$_POST["verifie"]."\" ";
	
	if(!empty($_POST['id'])) $req .= "WHERE id=".$_POST['id'];

	$query = mysqli_query($mysql_link,$req);
	
	//on rérupère les donnees
	$res = donnee("m_editorial","id",$last_id,"","",$mysql_link);


}

?>



<?php require("../../lib/include/n_i-meta.php"); ?>	

<title><?php echo rubrique($res['id_rubrique'],$mysql_link); ?> - Back Office</title>	
		
		
</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1"><?php echo rubrique($res['id_rubrique'],$mysql_link); ?> - Back Office</div>
			<div class="content bloc_arrondie">
			<?php echo $ariane = fil_ariance("admin","../",rubrique($res['id_rubrique'],$mysql_link),"index.php?id_rubrique=".$res['id_rubrique'],"Visualiser","","",""); ?>

			
			
			<h1><?php echo stripslashes($res['titre']); ?></h1>
			<?php if(!empty($res['chapeau'])){ ?><p><strong><?php echo stripslashes($res['chapeau']); ?></strong></p><?php } ?>
			
				<div class="big">
				

				<?php if((!empty($res['userfile2'])) AND ($res['id_rubrique'] == 19)){ echo $image = image($res['userfile2'],"flotD alingD mrgG10","","","","editorial",$res['titre_photo'],$res['id_photo']); } ?>

				<?php echo $image = image($res['userfile3'],"flotD alingD mrgG10",$res['legende3'],$res['copyright3'],"","editorial",$res['titre_photo'],$res['id_photo']); ?>
				
				<?php if(!empty($res['userfile4'])){ $image2 = image($res['userfile4'],"flotG alingG mrgD10",$res['legende4'],$res['copyright4'],"1","editorial","","");} ?>
				<?php if(!empty($res['corps'])){ ?><p <?php if(!empty($res['corps'])){ ?>class="center"<? } ?>><?php echo stripslashes(nl2br(ereg_replace("image2",$image2,$res['corps']))); ?></p> <?php } ?>
				
				<?php if(!empty($res['video_article'])){ ?><p class="center"><?php echo stripslashes(nl2br(ereg_replace("image2",$image2,$res['video_article']))); ?></p> <?php } ?>

				
				</div>
				
				
				
				
				<div class="alingJ clearB mrgT10">
				
				<?php 
				if(!empty($res['titre_photo'])){ 
					$plusdephoto = plusdephoto($res['titre_photo'],$res['id_photo'],"m_photo",$mysql_link);
					echo $plusdephoto;
				}
				?>
				
				
				<?php 
				if(!empty($res['nom_lien'])){ 
					$lien = lien($res['nom_lien'],$res['url_lien'],"_blank","",""); 
					echo '<p>'.$lien.'</p>';
				}
				?>
				
				<?php 
				if(!empty($res['titre_news'])){ 
					$plusdenews = plusdecontenu($res['titre_news'],$res['id_news'],"m_editorial",$mysql_link);
					echo $plusdenews;
				}
				?>
				
				<?php 
				if(!empty($res['titre_video'])){ 
					$plusdevideo = plusdecontenu($res['titre_video'],$res['id_video'],"m_editorial",$mysql_link);
					echo $plusdevideo;
				}
				?>
				
				
				<strong>URL : http://www.mango-surf.com/<?php echo urlFichier($res['id'],$res['id_rubrique'],$mysql_link); ?></strong>
				
				<p>
				
				<?php if(!empty($res["prix"])) echo "<br />Spot : ".stripslashes($res['prix'])." euros<br />"; ?>
				Publié le <?php echo $date_publication = dateformat($res["date_publication"],"en","fr"); ?>
				<?php if(!empty($res["spot"])) echo "<br />Spot : ".stripslashes($res['spot']); ?>
				<?php if(!empty($res["auteur"])) echo "<br />".stripslashes($res['auteur']); ?>
				
				
				</p>
				<section class="grid mt2">
					<div class="grid2">
						<div><div class="bouton txtcenter"><a href="ajout.php?id_rubrique=<?php echo $res['id_rubrique']; ?>&id=<?php echo $res['id']; ?>&id_sommaire=<?php echo $res['id_sommaire']; ?>" class="fontWhite" title="Modifier">Modifier</a></div></div>
						<?php 
				
						//Pour les rubrique culture et surf trip
						if ($res['id_rubrique'] == 4) $idrubrique=3;
						elseif ($res['id_rubrique'] == 6) $idrubrique=5;
						else $idrubrique = $res['id_rubrique'];
				
						?>
				
						<div><div class="bouton txtcenter"><a href="index.php?id_rubrique=<?php echo $idrubrique; ?>" class="fontWhite" title="Valider">Valider</a></div></div>
					</div>
				</section>
				
				</div>
			
				
			
			</div>
			
		</div>
			
	<?php require("../../lib/include/n_i-footer.php") ?>	


</div>
</body>

</html>