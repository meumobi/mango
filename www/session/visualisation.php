<?php 
$rubrique = 8;

require("../lib/fonction/f-connection.php");
require("../lib/fonction/f-formulaire.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/f-upload-fichier.php");
require("../lib/fonction/f-nom-fichier.php");
require("../lib/fonction/f-recadre-photo.php");

$no_sky = 1;
$no_photo = 1;


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
	}	
	
	// on prépare le nom du fichier
	$nom_fichier = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))); 
	
	// on prépare le nom des images
	$nom_fichier_image[3] = prepare_url(filtre_url(nom_fichier_define($_POST['legende3']))).'-'.$last_id;
	
	$req = $action_requette." m_editorial SET ";
	
	$req .= "id =\"".$last_id."\" ";
	$req .= ",id_rubrique = 8 ";
	$req .= ",id_cat =\"".$_POST['id_cat']."\" ";
	$req .= ",id_pays =\"".$_POST['id_pays']."\" ";
	$req .= ",id_region =\"".$_POST['id_region']."\" ";
	$req .= ",date_publication =\"".$date_publication."\" ";
	$req .= ",date_modification =\"".$date_modification."\" ";
	$req .= ",titre  =\"".addslashes(strip_tags($_POST['titre']))."\" ";
	$req .= ",chapeau  =\"".addslashes(strip_tags($_POST['chapeau']))."\" ";
	$req .= ",corps  =\"".addslashes(strip_tags($_POST['corps']))."\" ";
	$req .= ",auteur  =\"".addslashes(strip_tags($_POST['auteur']))."\" ";
	$req .= ",email  =\"".strip_tags($_POST['email'])."\" ";
	$req .= ",spot  =\"".addslashes(strip_tags($_POST['spot']))."\" ";

	// on upload les images + test
	
	$i = 3;
	
	if(!empty($_FILES['userfile'.$i]['name'])){
		require("../lib/fonction/f-connection-ftp.php");

		$taille = getimagesize($_FILES['userfile'.$i]['tmp_name']); 
		$h = $taille[1]; 
		$w = $taille[0]; 
		$poid = $_FILES['userfile'.$i]['size'];

		if (($h<=800) AND ($w<=800) AND ($poid<=800000)){
	
			$fichier_image = upload_fichier("m_editorial",$_FILES['userfile'.$i]['type'],"www/lib/image/editorial/",$nom_fichier_image[$i],$i,$supprimer_image,$last_id);
			
			$thumb = new Image("../lib/image/editorial/".$fichier_image);
			$thumb->crop = false;
			$thumb->width(265);
			$thumb->save();
			
			//Retaille la petite image//
			copy("../lib/image/editorial/".$fichier_image,"../lib/image/editorial/pt-".$fichier_image);
			
			$thumb = new Image("../lib/image/editorial/pt-".$fichier_image);
			$thumb->crop = false;
			$thumb->width(120);
			$thumb->save();

			$thumb = new Image("../lib/image/editorial/pt-".$fichier_image);
			$thumb->crop = true;
			$thumb->width(120);
			$thumb->height(70);
			$thumb->save();

			
			$fichier_image_pt = "pt-".$fichier_image;
			
			$req .= ",userfile".$i."  =\"".$fichier_image."\" ";
			$req .= ",userfile1  =\"".$fichier_image_pt."\" ";
		}
	}

	//fin upload
	
	$req .= ",legende3  =\"".addslashes(strip_tags($_POST["legende3"]))."\" ";
	$req .= ",copyright3  =\"".addslashes(strip_tags($_POST["copyright3"]))."\" ";
	
	$req .= ",en_ligne  = 2 ";
	$req .= ",nom_fichier  =\"".$nom_fichier."\" ";
	
	if(!empty($_POST['id'])) $req .= " WHERE id=".$_POST['id'];

	$query = mysqli_query($mysql_link,$req);
	
	//on rérupère les donnees
	$res = donnee("m_editorial","id",$last_id,"","",$mysql_link);

	
}

?>



<?php require("../lib/include/n_i-meta.php"); ?>	

<title>Visualisation de votre session</title>	
<meta name="robots" content="noindex">
		
		
</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">


	<?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1"><?php echo rubrique(8,$mysql_link); ?></div>
			<div class="line">
			
			<a href="/video/where-is-sancho-nias--4474.html"><div class="bouton txtcenter mt2 mb2">Merci d'avoir ajouté votre session. Une petite surprise si tu cliques !</div></a>
			
			
			<h1><?php echo stripslashes($res['titre']); ?></h1>
			<?php if(!empty($res['chapeau'])){ ?><p><strong><?php echo stripslashes($res['chapeau']); ?></strong></p><?php } ?>
			
				<div class="line">
				
				
				<?php if(!empty($res['userfile3'])){ echo image($res['userfile3'],"",$res['legende3'],$res['copyright3'],"1","editorial","","");} ?>
				
				<?php if(!empty($res['corps'])){ ?><p <?php if(!empty($res['corps'])){ ?>class="center"<? } ?>><?php echo stripslashes(nl2br(ereg_replace("image2",$image2,$res['corps']))); ?></p> <?php } ?>
				
				</div>
				
				
				
				
				<div class="alingJ clearB mrgT10">
				
				<?php 
				if(!empty($res['titre_photo'])){ 
					$plusdephoto = plusdephoto($res['titre_photo'],$res['id_photo'],"m_photo",$mysql_link);
					echo $plusdephoto;
				}
				?>
						
				<p>
				Publié le <?php echo $date_publication = dateformat($res["date_publication"],"en","fr"); ?>
				<?php if(!empty($res["spot"])) echo "<br />Spot : ".stripslashes($res['spot']); ?>
				<?php if(!empty($res["auteur"])) echo "<br />".stripslashes($res['auteur']); ?>
				
				
				</p>
				
				

				</div>
			
				
			
			</div>
			
		</div>
			
	<?php require("../lib/include/n_i-footer.php") ?>	
	

</div>
</body>

</html>