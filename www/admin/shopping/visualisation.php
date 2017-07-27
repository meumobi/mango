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
		$date_publication = dateformat($_POST["date_publication"],"fr","en");
				
	}else{
		$action_requette = "INSERT INTO";
		$last_id = last_id("m_shopping",$mysql_link);
		
		$date_publication = dateformat($_POST["date_publication"],"fr","en");
	}	
	
	// on prépare le nom du fichier
	$nom_fichier = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))); 
	
	// on prépare le nom des images
	$nom_fichier_image[1] = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))).'-'.$last_id;
	$nom_fichier_image[2] = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))).'-'.$last_id;
	
	
	$req = $action_requette." m_shopping SET ";
	
	$req .= "id =\"".$last_id."\" ";
	$req .= ",id_rubrique =\"".$_POST['id_rubrique']."\" ";
	$req .= ",id_cat =\"".$_POST['id_cat']."\" ";
	$req .= ",id_marque =\"".$_POST['id_marque']."\" ";
	$req .= ",date_publication =\"".$date_publication."\" ";
	$req .= ",titre  =\"".addslashes($_POST['titre'])."\" ";
	$req .= ",corps  =\"".addslashes($_POST['corps'])."\" ";
	$req .= ",prix  =\"".$_POST['prix']."\" ";
	$req .= ",nom_shop  =\"".$_POST['nom_shop']."\" ";
	$req .= ",url_shop  =\"".$_POST['url_shop']."\" ";
	$req .= ",titre_video  =\"".addslashes($_POST['titre_video'])."\" ";
	$req .= ",id_video  =\"".$_POST['id_video']."\" ";
	$req .= ",titre_news  =\"".addslashes($_POST['titre_news'])."\" ";
	$req .= ",id_news  =\"".$_POST['id_news']."\" ";
	
	$req .= ",titre_photo  =\"".addslashes($_POST['titre_photo'])."\" ";
	$req .= ",id_photo  =\"".$_POST['id_photo']."\" ";
	

	if(!empty($_FILES['userfile2']['name'])){

		// on copie l'image sur le serveur
		$fichier_image_une = upload_fichier("m_shopping",$_FILES['userfile2']['type'],"www/lib/image/shopping/",$nom_fichier_image[2],"2",$supprimer_image,$last_id);
		
		// on prepare la petite image
		$nom_fichier_image_p = "p-".$fichier_image_une;
		copy("../../lib/image/shopping/".$fichier_image_une,"../../lib/image/shopping/".$nom_fichier_image_p);
		
		$thumb = new Image("../../lib/image/shopping/".$nom_fichier_image_p);
		$thumb->width(90);
		$thumb->save();
		
		// on prepare la petite image
		$nom_fichier_image_m = "m-".$fichier_image_une;
		copy("../../lib/image/shopping/".$fichier_image_une,"../../lib/image/shopping/".$nom_fichier_image_m);
		
		$thumb = new Image("../../lib/image/shopping/".$nom_fichier_image_m);
		$thumb->width(148);
		$thumb->save();
		
		// On integre le nom de l'image en bdd
		$req .= ",userfile1 =\"".$nom_fichier_image_p."\" ";
		$req .= ",userfile2 =\"".$fichier_image_une."\" ";
		$req .= ",userfile3 =\"".$nom_fichier_image_m."\" ";
	}

	
	
	$req .= ",no_iphone  =\"".$_POST["no_iphone"]."\" ";
	$req .= ",no_comment  =\"".$_POST["no_comment"]."\" ";
	$req .= ",en_ligne  =\"".$_POST["en_ligne"]."\" ";
	$req .= ",promotion  =\"".$_POST["promotion"]."\" ";
	$req .= ",nom_fichier  =\"".$nom_fichier."\" ";
	
	
	if(!empty($_POST['id'])) $req .= "WHERE id=".$_POST['id'];

	$query = mysqli_query($mysql_link,$req);
	
	//on rérupère les donnees
	$res = donnee("m_shopping","id",$last_id,"","",$mysql_link);
	
}

?>



<?php require("../../lib/include/n_i-meta.php"); ?>	

<title>Shopping - Back Office</title>	
		
		
</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Shopping - Back Office</div>
			<div class="content bloc_arrondie">
			<?php echo $ariane = fil_ariance("admin","../","Shopping","index.php?id_rubrique=".$_GET['id_rubrique'],"Visualiser","","",""); ?>

			<h1><?php echo stripslashes($res['titre']); ?></h1>
			
			<div class="alingJ clearB">
			
				<?php echo $image = image($res['userfile2'],"right","","","","shopping","",""); ?>
				<?php if(!empty($res['corps'])){ ?><?php echo stripslashes(nl2br($res['corps'])); ?><?php } ?>
				
				<p>
				<?php if(!empty($res['id_marque'])){ ?>
				<strong>Marque : <?php echo $marque = marque($res['id_marque'],$mysql_link); ?></strong><br />
				
				<?php } ?>
				<?php if(!empty($res['id_cat'])){ ?>
				<strong>Catégorie : <?php echo $marque = categorie($res['id_cat'],$mysql_link); ?></strong><br />
				
				<?php } ?>
				
				
				</p>
			
			</div>
				
				
				
				
				<div class="alingJ clearB mrgT10">
				
				<?php 
				if(!empty($res['nom_shop'])){ 
					$lien = lien($res['nom_shop'],$res['url_shop'],"_blank","",""); 
					echo '<p>'.$lien.'</p>';
				}
				?>
				
				<?php 
				if(!empty($res['titre_news'])){ 
					$plusdenews = plusdecontenu($res['titre_news'],$res['id_news'],"m_shopping",$mysql_link);
					echo $plusdenews;
				}
				?>
				
				<?php 
				if(!empty($res['titre_video'])){ 
					$plusdevideo = plusdecontenu($res['titre_video'],$res['id_video'],"m_shopping",$mysql_link);
					echo $plusdevideo;
				}
				?>
				
				<section class="grid mt2">
					<div class="grid2">
						<div><div class="bouton txtcenter"><a class="fontWhite" href="ajout.php?id_rubrique=<?php echo $res['id_rubrique']; ?>&id=<?php echo $res['id']; ?>" title="Modifier">Modifier</a></div></div>
						<div><div class="bouton txtcenter"><a class="fontWhite" href="index.php?id_rubrique=<?php echo $res['id_rubrique']; ?>" title="Valider">Valider</a></div></div>
					</div>
				</section>		

				</div>
			
				
			
			</div>
			
		</div>
			
<?php require("../../lib/include/n_i-footer.php") ?>	
	

</div>
</body>

</html>