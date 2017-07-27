<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/f-formulaire.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/f-upload-fichier.php");
require("../../lib/fonction/f-nom-fichier.php");


if($_POST['a'] == 1){

	if(!empty($_POST['id'])) {
		$action_requette = "UPDATE";
		$last_id = $_POST['id'];	
		
		$mois = explode("/",$_POST["date_debut"]);
		
		$date_debut = dateformat($_POST["date_debut"],"fr","en");
		$date_fin = dateformat($_POST["date_fin"],"fr","en");
		
	}else{
		$action_requette = "INSERT INTO";
		$last_id = last_id("m_agenda",$mysql_link);

		$mois = explode("/",$_POST["date_debut"]);

		$date_debut = dateformat($_POST["date_debut"],"fr","en");
		$date_fin = dateformat($_POST["date_fin"],"fr","en");
	}	
	
	// on prépare le nom du fichier
	$nom_fichier = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))); 
	
	// on prépare le nom des images
	$nom_fichier_image[1] = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))).'-'.$last_id;
	$nom_fichier_image[2] = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))).'-'.$last_id;
	
	$req = $action_requette." m_agenda SET ";
	
	$req .= "id =\"".$last_id."\" ";
	$req .= ",id_rubrique =\"".$_POST['id_rubrique']."\" ";
	$req .= ",id_tag =\"".$_POST['id_tag']."\" ";
	$req .= ",date_debut =\"".$date_debut."\" ";
	$req .= ",date_fin =\"".$date_fin."\" ";
	$req .= ",mois  =\"".$mois[1]."\" ";
	$req .= ",titre  =\"".addslashes($_POST['titre'])."\" ";
	$req .= ",corps  =\"".addslashes($_POST['corps'])."\" ";
	$req .= ",lieu  =\"".addslashes($_POST["lieu"])."\" ";
	$req .= ",email  =\"".$_POST["email"]."\" ";
	

	// on upload les images
	for($i=1; $i <= 2; $i++){
		if(!empty($_FILES['userfile'.$i]['name'])){
			$fichier_image = upload_fichier("m_agenda",$_FILES['userfile'.$i]['type'],"www/lib/image/agenda/",$nom_fichier_image[$i],$i,$supprimer_image,$last_id);
			$req .= ",userfile".$i."  =\"".$fichier_image."\" ";
		}
	}
	

	$req .= ",legende  =\"".addslashes($_POST["legende"])."\" ";
	$req .= ",copyright  =\"".addslashes($_POST["copyright"])."\" ";
	
	$req .= ",nom_lien  =\"".addslashes($_POST['nom_lien'])."\" ";
	$req .= ",url_lien  =\"".$_POST['url_lien']."\" ";
	$req .= ",titre_video  =\"".addslashes($_POST['titre_video'])."\" ";
	$req .= ",id_video  =\"".$_POST['id_video']."\" ";
	$req .= ",titre_news  =\"".addslashes($_POST['titre_news'])."\" ";
	$req .= ",id_news  =\"".$_POST['id_news']."\" ";
	$req .= ",titre_photo  =\"".addslashes($_POST['titre_photo'])."\" ";
	$req .= ",id_photo  =\"".$_POST['id_photo']."\" ";
	$req .= ",en_ligne  =\"".$_POST["en_ligne"]."\" ";
	$req .= ",no_iphone  =\"".$_POST["no_iphone"]."\" ";
	$req .= ",box_event  =\"".$_POST["box_event"]."\" ";
	$req .= ",nom_fichier  =\"".$nom_fichier."\" ";
	
	if(!empty($_POST['id'])) $req .= "WHERE id=".$_POST['id'];
	
	$query = mysqli_query($mysql_link,$req);
	
	//on rérupére les donnees
	$res = donnee("m_agenda","id",$last_id,"","",$mysql_link);
	
}

?>



<?php require("../../lib/include/n_i-meta.php"); ?>	

<title>Agenda - Back Office</title>	
		
		
</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Agenda - Back Office</div>
			<div class="content bloc_arrondie">
			<?php echo $ariane = fil_ariance("admin","../","Agenda","index.php?id_rubrique=".$res['id_rubrique'],"Visualiser","","",""); ?>

			<h1><?php echo stripslashes($res['titre']); ?></h1>
			

				<div class="alingJ clearB">
				
				<?php if(!empty($res['userfile2'])) echo $image = image($res['userfile2'],"flotD alingD mrgG10",$res['legende'],$res['copyright'],"","agenda",$res['titre_photo'],$res['id_photo']); ?>

								
				<p><?php if(!empty($res['corps']))echo stripslashes(nl2br($res['corps'])); ?></p>
				
				<?php if(!empty($res['lieu'])){ echo '<strong>Lieu : </strong>'.stripslashes($res['lieu']).'<br />'; } ?>
				<strong>Date :</strong> <?php echo $date_publication = dateformat($res["date_debut"],"en","fr"); ?> au <?php echo $date_publication = dateformat($res["date_fin"],"en","fr"); ?><br />
				<?php if(!empty($res['email'])){ echo '<strong>Email contact : </strong>'.stripslashes($res['email']).'<br />'; } ?>
				
				
				</div>
				
				<div class="alingJ clearB mrgT10">
				
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