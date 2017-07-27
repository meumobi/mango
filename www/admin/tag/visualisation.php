<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/f-formulaire.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/f-upload-fichier.php");
require("../../lib/fonction/f-nom-fichier.php");


if(($_POST['force_ajout'] != 1) AND (empty($_POST['id']))){
	
	if(!empty($_POST['mot_cle'])){
		$mot_cles = explode("-",$_POST['mot_cle']);
		$nbr_ligne = count($mot_cles);
	}else{
		$mot_cles = explode(" ",$_POST['nom']);
		$nbr_ligne = count($mot_cles);
	}
	
	$req_exist = "SELECT nom FROM m_tag WHERE (id_cat = ".$_POST['id_cat'].") AND (";
	
	$i=1;
	foreach($mot_cles as $mc){
		$req_exist .= "(mot_cle LIKE '%".$mc."%')";
	
		if ($i != $nbr_ligne){
			$req_exist .= " OR ";	
		}
		
		$i++;
	}
	
	$req_exist .= ") AND id_rubrique = 18";
	
	
	$query_exist = mysqli_query($mysql_link,$req_exist);
	$nbr_exist = mysqli_num_rows($query_exist);

}


if((($_POST['a'] == 1) AND (empty($nbr_exist))) OR (($_POST['force_ajout'] == 1))){

	if(!empty($_POST['id'])) {
		$action_requette = "UPDATE";
		$last_id = $_POST['id'];			
	}else{
		$action_requette = "INSERT INTO";
		$last_id = last_id("m_tag",$mysql_link);
	}	
	
	// on prépare le nom du fichier
	$nom_fichier = prepare_url(filtre_url(nom_fichier_define($_POST['nom']))); 
	
	// on prépare le nom des images
	$nom_fichier_image[1] = prepare_url(filtre_url(nom_fichier_define($_POST['nom']))).'-'.$last_id;

	
	
	$req = $action_requette." m_tag SET ";
	
	$req .= "id =\"".$last_id."\" ";
	$req .= ",id_rubrique =\"".$_POST['id_rubrique']."\" ";
	$req .= ",id_cat =\"".$_POST['id_cat']."\" ";
	$req .= ",nom  =\"".addslashes($_POST['nom'])."\" ";
	
	if(empty($_POST['mot_cle'])){
		
		$mot_cles = explode(" ",$_POST['nom']);
		$nbr_mc_tempo = count($mot_cles);
		
		$i=1;
		foreach($mot_cles as $mc){
			$mot_cle_tempo .= $mc;
			if($nbr_mc_tempo != $i) $mot_cle_tempo .= " - ";
			
			$i++;
		}
		
		$req .= ",mot_cle  =\"".addslashes($mot_cle_tempo)."\" ";

	}else{
		$req .= ",mot_cle  =\"".addslashes($_POST['mot_cle'])."\" ";
	}
	
	// on copie l'image sur le serveur
	
	if(!empty($_FILES['userfile1']['name'])){
	
		if($_POST['id_cat'] == 32) $chemin_image = "shopping/marque/";
		if($_POST['id_cat'] == 33) $chemin_image = "photographe/";
		if($_POST['id_cat'] == 34) $chemin_image = "surfeur/";
	
	
		$fichier_image = upload_fichier("m_tag",$_FILES['userfile1']['type'],"www/lib/image/".$chemin_image,$nom_fichier_image[1],"1",$supprimer_image,$last_id);
		$req .= ",userfile1  =\"".$fichier_image."\" ";
	
		$req .= ",legende  =\"".$_POST["legende"]."\" ";
		$req .= ",copyright  =\"".$_POST["copyright"]."\" ";
	}
	
	
	$req .= ",corps  =\"".addslashes($_POST['corps'])."\" ";
	$req .= ",en_ligne  =\"".$_POST["en_ligne"]."\" ";
	$req .= ",force_ajout  =\"".$_POST["force_ajout"]."\" ";
	$req .= ",nom_fichier  =\"".$nom_fichier."\" ";
	
	if(!empty($_POST['id'])) $req .= "WHERE id=".$_POST['id'];
	
	$query = mysqli_query($mysql_link,$req);
	
	//on rérupère les donnees
	$res = donnee("m_tag","id",$last_id,"","",$mysql_link);
	
}

?>



<?php require("../../lib/include/n_i-meta.php"); ?>	

<title>Tag - Back Office</title>	
		
		
</head>

<body>
<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Tag - Back Office;</div>
			<div class="content bloc_arrondie">
			<?php echo $ariane = fil_ariance("admin","../","Tag","index.php?id_rubrique=".$_GET['id_rubrique'],"Visualiser","","",""); ?>


			<h1><?php echo stripslashes($res['nom']); ?></h1>
			
				<div class="alingJ clearB">
			
				
				<p>
				<?php if(!empty($res['mot_cle']))echo "Tag pour la recherche ".stripslashes(nl2br($res['mot_cle'])); ?>
				<?php if(!empty($res['corps']))echo stripslashes(nl2br($res['corps'])); ?>
				
				<?php
				
				if((!empty($nbr_exist)) AND (empty($_GET['force_ajout']))){
					
					echo "<strong>Tag similaire</strong><br /><br />"; 
					
					while ($res_exist = mysqli_fetch_array($query_exist)){
					
						echo $res_exist['nom']."<br />";
				
					}
					
					echo "<br />Si vous souhaitez ajouter ce tag, cliquer sur le bouton précédent de votre navigateur et cocher Forcer l'ajout<br />"; 

				}
				?>
				
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