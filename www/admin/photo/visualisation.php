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
		$last_id = last_id("m_photo",$mysql_link);
		$date_publication = dateformat($_POST["date_publication"],"fr","en");

	}	
	
	// on prépare le nom du fichier
	$nom_fichier = prepare_url(filtre_url(nom_fichier_define($_POST['legende']))); 
	
	// on prépare le nom des images
	$nom_fichier_image[1] = prepare_url(filtre_url(nom_fichier_define($_POST['legende']))).'-'.$last_id;
	$nom_fichier_image[2] = prepare_url(filtre_url(nom_fichier_define($_POST['legende']))).'-'.$last_id;
	
	
	$req = $action_requette." m_photo SET ";
	
	$req .= "id =\"".$last_id."\" ";
	$req .= ",id_rubrique =\"".$_POST['id_rubrique']."\" ";
	$req .= ",id_cat =\"".$_POST['id_cat']."\" ";
	$req .= ",id_photographe =\"".$_POST['id_photographe']."\" ";
	$req .= ",id_emplacement =\"".$_POST['id_emplacement']."\" ";
	$req .= ",id_tag =\"".$_POST['id_tag']."\" ";
	$req .= ",id_produit =\"".$_POST['id_produit']."\" ";
	$req .= ",id_portfolio =\"".$_POST['id_portfolio']."\" ";

	
	
	// on upload les images
	if(!empty($_FILES['userfile1']['name'])){
			$fichier_image = upload_fichier("m_photo",$_FILES['userfile1']['type'],"www/lib/image/photo/",$nom_fichier_image[1],1,$supprimer_image,$last_id);
			//$req .= ",userfile0  =\"".$fichier_image."\" ";
			$req .= ",userfile2  =\"".$fichier_image."\" ";
						
			
			//on copie la grande image en une pour la home du site 320x160
			copy("../../lib/image/photo/".$fichier_image,"../../lib/image/photo/320x160-".$fichier_image);
			
			$thumb = new Image("../../lib/image/photo/320x160-".$fichier_image);
			$thumb->crop = false;
			$thumb->width(320);
			$thumb->height(160);
			$thumb->save();
			
			$req .= ",userfile3  =\"320x160-".$fichier_image."\" ";
			
			//on copie la grande image en vignette 150x100
			copy("../../lib/image/photo/".$fichier_image,"../../lib/image/photo/mini_".$fichier_image);
			
			$thumb = new Image("../../lib/image/photo/mini_".$fichier_image);
			$thumb->width(150);
			$thumb->height(100);
			$thumb->save();
			
			$req .= ",userfile1  =\"mini_".$fichier_image."\" ";
			
	}
	
	
	$req .= ",legende  =\"".addslashes($_POST["legende"])."\" ";
	$req .= ",copyright  =\"".addslashes($_POST["copyright"])."\" ";
	$req .= ",titre  =\"".addslashes($_POST['titre'])."\" ";
	$req .= ",chapeau  =\"".addslashes($_POST['chapeau'])."\" ";
 	$req .= ",corps  =\"".addslashes($_POST['corps'])."\" ";
	$req .= ",date_publication =\"".$date_publication."\" ";
	$req .= ",no_iphone  =\"".$_POST["no_iphone"]."\" ";
	$req .= ",belle_photo  =\"".$_POST["belle_photo"]."\" ";
	$req .= ",no_comment  =\"".$_POST["no_comment"]."\" ";
	$req .= ",no_menu  =\"".$_POST["no_menu"]."\" ";
	$req .= ",en_ligne  =\"".$_POST["en_ligne"]."\" ";
	$req .= ",nom_fichier  =\"".$nom_fichier."\" ";
	
	
	if(!empty($_POST['id'])) $req .= "WHERE id=".$_POST['id'];

	$query = mysqli_query($mysql_link,$req);
	
	//on rérupère les donnees
	$res = donnee("m_photo","id",$last_id,"","",$mysql_link);
}

?>



<?php require("../../lib/include/n_i-meta.php"); ?>	

<title>Galerie Photo - Back Office</title>	
		
		
</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Galerie Photo - Back Office</div>
			<div class="content bloc_arrondie">
			<?php echo $ariane = fil_ariance("admin","../","Galerie Photo","index.php?id_rubrique=".$_GET['id_rubrique'],"Visualiser","","",""); ?>

			
			<h1><?php echo stripslashes($res['legende']); ?></h1><br />
			
			<?php if(!empty($res['titre'])){ ?>
				<strong><?php echo $res['titre']; ?></strong><br />
			<?php } ?>
			
			<?php if(!empty($res['chapeau'])){ ?><p><strong><?php echo stripslashes($res['chapeau']); ?></strong></p><?php } ?>
			
			<?php if(!empty($res['corps'])){ ?><p><?php echo stripslashes($res['corps']); ?></p><?php } ?>
			
			
			<div class="clearB">
			
				<?php echo $image = image($res['userfile2'],"alingC","","","","photo","",""); ?>
				
				<p class="alingC">
				<?php echo $res['copyright']; ?>
				
				<?php if(!empty($res['id_photographe'])){ ?>
				<strong>Photographe : <?php echo $marque = marque($res['id_photographe'],$mysql_link); ?></strong><br />
				
				<?php } ?>
				
				
				<?php if(!empty($res['id_cat'])){ ?>
				<br /><strong>Catégorie : <?php echo $marque = categorie($res['id_cat'],$mysql_link); ?></strong>
				
				<?php } ?>
				
				
				</p>
			
			</div>
				
			<section class="grid mt2">
					<div class="grid2">
						<div><div class="bouton txtcenter"><a class="fontWhite" href="ajout.php?id_rubrique=<?php echo $res['id_rubrique']; ?>&id=<?php echo $res['id']; ?>" title="Modifier">Modifier</a></div></div>
						<div><div class="bouton txtcenter"><a class="fontWhite" href="index.php?id_rubrique=<?php echo $res['id_rubrique']; ?>" title="Valider">Valider</a></div></div>
					</div>
				</section>		

			
				
			
			</div>
			
		</div>
			
<?php require("../../lib/include/n_i-footer.php") ?>	
	

</div>
</body>

</html>