<?php 
$rubrique = 16;

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
				
		$date_debut = dateformat($_POST["date_debut"],"fr","en","/");
		$date_fin = dateformat($_POST["date_fin"],"fr","en","/");
		
	}else{
		$action_requette = "INSERT INTO";
		$last_id = last_id("m_agenda",$mysql_link);
		
		$date_debut = dateformat($_POST["date_debut"],"fr","en","/");
		$date_fin = dateformat($_POST["date_fin"],"fr","en","/");
	}	
	
	// on prépare le nom du fichier
	$nom_fichier = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))); 
	
	// on prépare le nom des images
	$nom_fichier_image[1] = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))).'-'.$last_id;
	$nom_fichier_image[2] = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))).'-'.$last_id;
	
	
	$req = $action_requette." m_agenda SET ";
	
	$req .= "id =\"".$last_id."\" ";
	$req .= ",id_rubrique = 16";
	$req .= ",date_debut =\"".$date_debut."\" ";
	$req .= ",date_fin =\"".$date_fin."\" ";
	$req .= ",titre  =\"".addslashes(strip_tags($_POST['titre']))."\" ";
	$req .= ",corps  =\"".addslashes(strip_tags($_POST['corps']))."\" ";
	$req .= ",lieu  =\"".addslashes(strip_tags($_POST["lieu"]))."\" ";
	$req .= ",email  =\"".strip_tags($_POST["email"])."\" ";
	
	// on upload les images + test
	
	$i = 2;
	
	if(!empty($_FILES['userfile'.$i]['name'])){
		require("../lib/fonction/f-connection-ftp.php");

		
		$taille = getimagesize($_FILES['userfile'.$i]['tmp_name']); 
		$h = $taille[1]; 
		$w = $taille[0]; 
		$poid = $_FILES['userfile'.$i]['size'];

		if (($h<=800) AND ($w<=800) AND ($poid<=800000)){
	
		$fichier_image = upload_fichier("m_agenda",$_FILES['userfile'.$i]['type'],"www/lib/image/agenda/",$nom_fichier_image[$i],$i,$supprimer_image,$last_id);
		
		$thumb = new Image("../lib/image/agenda/".$fichier_image);
		$thumb->crop = false;
		$thumb->width(265);
		$thumb->save();

			
		$req .= ",userfile".$i."  =\"".$fichier_image."\" ";
			
		}
	}

	//fin upload
	
	$req .= ",legende  =\"".addslashes(strip_tags($_POST["legende"]))."\" ";
	$req .= ",copyright  =\"".addslashes(strip_tags($_POST["copyright"]))."\" ";
	$req .= ",en_ligne  = 2";
	$req .= ",nom_fichier  =\"".$nom_fichier."\" ";
	
	if(!empty($_POST['id'])) $req .= "WHERE id=".$_POST['id'];
	
	$query = mysqli_query($mysql_link,$req);
	
	//on rérupère les donnees
	$res = donnee("m_agenda","id",$last_id,"","",$mysql_link);
	
}

?>



<?php require("../lib/include/n_i-meta.php"); ?>	

<title>Visualisation de votre manifestation</title>	
<meta name="robots" content="noindex">
	
		
</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">


	<?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Agenda</div>
			
			<a href="/video/thundercloud-cloudbreak-documentaire--4553.html"><div class="bouton txtcenter mt2 mb2">Merci d'avoir ajouté votre manifestation. Une petite surprise si tu cliques !</div></a>

			
			<div class="line">
			
			
			
			<h1><?php echo stripslashes($res['titre']); ?></h1>
			

				<div>
				
				<?php if(!empty($res['userfile2'])) echo $image = image($res['userfile2'],"right",$res['legende'],$res['copyright'],"","agenda","",""); ?>
				

				
								
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
				
				</div>
				

				
				

				
				</div>
			
				
			
			</div>
			
		</div>
			
	<?php require("../lib/include/n_i-footer.php") ?>

</div>
</body>

</html>