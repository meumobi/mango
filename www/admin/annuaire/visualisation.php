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
		
		$date_debut = dateformat($_POST["date_debut"],"fr","en");
		$date_fin = dateformat($_POST["date_fin"],"fr","en");
		
		$id_cat_ariane = $_POST['id_cat'];
	
	}else{
		$action_requette = "INSERT INTO";
		$last_id = last_id("m_annuaire",$mysql_link);
		
		$date_debut = dateformat($_POST["date_debut"],"fr","en");
		$date_fin = dateformat($_POST["date_fin"],"fr","en");
		
		$id_cat_ariane = $_GET['id_cat'];


	}	
	
	// on prépare le nom du fichier
	$nom_fichier = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))); 
	
	// on prépare le nom des images
	$nom_fichier_image[1] = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))).'-logo'.$last_id;
	$nom_fichier_image[2] = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))).'-photo'.$last_id;

	
	$req = $action_requette." m_annuaire SET ";
	
	$req .= "id =\"".$last_id."\" ";
	$req .= ",id_rubrique = 14 ";
	$req .= ",id_pays =\"".$_POST['id_pays']."\" ";
	$req .= ",id_region =\"".$_POST['id_region']."\" ";
	$req .= ",id_cat =\"".$_POST['id_cat']."\" ";
	$req .= ",titre  =\"".addslashes($_POST['titre'])."\" ";
	$req .= ",corps  =\"".addslashes($_POST['corps'])."\" ";

    if(!empty($_FILES['userfile1']['name'])) {
        $fichier_image1 = upload_fichier("m_annuaire", $_FILES['userfile1']['type'], "www/lib/image/annuaire/", $nom_fichier_image[1], 1, $supprimer_image, $last_id);
        $req .= ",userfile1  =\"" .$fichier_image1. "\" ";
    }

    if(!empty($_FILES['userfile2']['name'])) {
        $fichier_image2 = upload_fichier("m_annuaire", $_FILES['userfile2']['type'], "www/lib/image/annuaire/", $nom_fichier_image[2], 2, $supprimer_image, $last_id);
        $req .= ",userfile2  =\"" .$fichier_image2. "\" ";
    }

	
	// on upload les images
	/*for($i=1; $i <= 2; $i++){
		if(!empty($_FILES['userfile'.$i]['name'])){
			$fichier_image[$i] = upload_fichier("m_annuaire",$_FILES['userfile'.$i]['type'],"www/lib/image/annuaire/",$nom_fichier_image[$i],$i,$supprimer_image,$last_id);
			$req .= ",userfile".$i."  =\"".$fichier_image[$i]."\" ";
		}
	}*/
	
	$req .= ",adresse  =\"".addslashes($_POST["adresse"])."\" ";
	$req .= ",cp  =\"".$_POST["cp"]."\" ";
	$req .= ",ville  =\"".addslashes($_POST["ville"])."\" ";
	$req .= ",email  =\"".$_POST["email"]."\" ";
	$req .= ",telephone  =\"".$_POST["telephone"]."\" ";
	$req .= ",url_lien  =\"".$_POST['url_lien']."\" ";
	$req .= ",nom_fichier  =\"".$nom_fichier."\" ";
	
	if($_POST["en_ligne"] == 1){
		$req .= ",en_ligne  =\"".$_POST["en_ligne"]."\" ";
	}else{
		$req .= ",en_ligne  = 2 ";
	}

	$req .= ",no_comment  =\"".$_POST["no_comment"]."\" ";
	$req .= ",client =\"".$_POST["client"]."\" ";
	$req .= ",date_fin =\"".$date_fin."\" ";

	$req .= ",date_debut =\"".$date_debut."\" ";
	$req .= ",date_fin =\"".$date_fin."\" ";

	if(!empty($_POST['id'])) $req .= "WHERE id=".$_POST['id'];
	$query = mysqli_query($mysql_link,$req);
	
	//on rérupère les donnees
	$res = donnee("m_annuaire","id",$last_id,"","",$mysql_link);
	
}

?>



<?php require("../../lib/include/n_i-meta.php"); ?>	

<title>Annuaire - Back Office</title>	
		
		
</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Annuaire - Back Office</div>
			<div class="content bloc_arrondie">
			<?php echo $ariane = fil_ariance("admin","../","Annuaire ".categorie($id_cat_ariane,$mysql_link),"index.php?id_cat=".$id_cat_ariane,"Visualiser","","",""); ?>
			<h1><?php echo stripslashes($res['titre']); ?></h1>
			
				<div class="line">

				
				<?php if(!empty($res['userfile2'])) echo $image = image($res['userfile2'],"right",$res['legende'],$res['copiryght'],"","annuaire","",""); ?>
				
				<p><?php if(!empty($res['corps']))echo stripslashes(nl2br($res['corps'])); ?></p>
				
				</div>
				
				
				
				
				<div class="alingJ clearB mrgT10">
				
				<?php if(!empty($res['contact'])){ echo stripslashes($res['contact']).'<br />'; } ?>
				<?php if(!empty($res['adresse'])){ echo stripslashes($res['adresse']).'<br />'; } ?>
				<?php if(!empty($res['cp'])){ echo stripslashes($res['cp']).' - '; } ?>
				<?php if(!empty($res['ville'])){ echo stripslashes($res['ville']).'<br />'; } ?>
				<?php if(!empty($res['telephone'])){ echo stripslashes($res['telephone']).'<br />'; } ?>
				<?php if(!empty($res['email'])){ echo stripslashes($res['email']).'<br />'; } ?>
				<?php if(!empty($res['url'])){ echo '<a href="'.$res['url'].'">cliquez ici</a><br />'; } ?>
				
				</div>
				
				<section class="grid mt2">
					<div class="grid2">
						<div><div class="bouton txtcenter"><a class="fontWhite" href="ajout.php?id_cat=<?php echo $res['id_cat']; ?>&id=<?php echo $res['id']; ?>" title="Modifier">Modifier</a></div></div>
				
				<div><div class="bouton txtcenter"><a class="fontWhite" href="index.php?id_cat=<?php echo $res['id_cat']; ?>" title="Valider">Valider</a></div></div>
				
				</div>
				</section
			
				
			
			</div>
			
		</div>
			
	<?php require("../../lib/include/n_i-footer.php") ?>	


</div>
</body>

</html>