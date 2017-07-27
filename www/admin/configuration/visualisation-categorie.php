<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/f-formulaire.php");
require("../../lib/fonction/f-all.php");
require("../../lib/fonction/f-upload-fichier.php");
require("../../lib/fonction/f-nom-fichier.php");

if($_POST['a'] == 1){

	if(!empty($_POST['id'])) {
		$action_requette = "UPDATE";
		$last_id = $_POST['id'];
	}else{
		$action_requette = "INSERT INTO";
		$last_id = last_id("m_cat",$mysql_link);
	}	
	
	
	
	$req = $action_requette." m_cat SET ";
	
	$req .= "id =\"".$last_id."\" ";
	$req .= ",id_rubrique =\"".$_POST['rubrique']."\" ";
	$req .= ",nom =\"".addslashes($_POST['nom'])."\" ";
	$req .= ",presentation  =\"".addslashes($_POST["presentation"])."\" ";
	$req .= ",presentation_longue  =\"".addslashes($_POST["presentation_longue"])."\" ";
	$req .= ",dossier =\"".$_POST['dossier']."\" ";
	
	if(!empty($_FILES['userfile1']['name'])){

		$nom_fichier_image = prepare_url(filtre_url(nom_fichier_define($_POST['nom']))).'-'.$last_id;

		$fichier_image = upload_fichier("m_cat",$_FILES['userfile1']['type'],"www/lib/image/template/",$nom_fichier_image,1,$supprimer_image,$last_id);
		$req .= ",image  =\"".$fichier_image."\" ";
		

	}
	
	$req .= ",nom_fichier  =\"".$_POST['nom_fichier']."\" ";

	if(!empty($_POST['id'])) $req .= "WHERE id=".$_POST['id'];
	$query = mysqli_query($mysql_link,$req);
	
	//on rérupère les donnees
	$res = donnee("m_cat","id",$last_id,"","",$mysql_link);
	
}

?>



<?php require("../../lib/include/n_i-meta.php"); ?>	

<title>Configuration du site - Back Office</title>	
		
		
</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Catégorie</div>
			<div class="content bloc_arrondie">
			<?php echo $ariane = fil_ariance("admin","../","configuration du site","index.php","Visualiser","","",""); ?>

			
			<h1>Nom de la catégorie : <?php echo stripslashes($res['nom']); ?></h1>
			
				<div class="alingJ clearB">
				<p>
					Nom de la rubrique : <?php echo rubrique($res['id_rubrique']); ?><br />
					Présentation courte : <?php echo stripslashes($res['presentation']); ?><br />
					Présentation longue : <?php echo stripslashes($res['presentation_longue']); ?><br />
					Dossier : <?php echo stripslashes($res['dossier']); ?><br />
					Nom du fichier<?php echo stripslashes($res['nom_fichier']); ?><br />
					Illustration : <?php echo stripslashes($res['image']); ?><br /><br />
					
					<img src="../../lib/image/template/<?php echo $res['image']; ?>" />
				
				
				
				</p>
				
				</div>
				
				
				
				
				
				<section class="grid mt2">
					<div class="grid2">
						<div><div class="bouton txtcenter"><a class="fontWhite" href="ajout-categorie.php?id_rubrique=<?php echo $res['id_rubrique']; ?>&id=<?php echo $res['id']; ?>" title="Modifier">Modifier</a></div></div>
						<div><div class="bouton txtcenter"><a class="fontWhite" href="index.php?id_rubrique=<?php echo $res['id_rubrique']; ?>" title="Valider">Valider</a></div></div>
					</div>
				</section>
				</div>
			
				
			
			
		</div>
			
	<?php require("../../lib/include/n_i-footer.php") ?>


</div>
</body>

</html>