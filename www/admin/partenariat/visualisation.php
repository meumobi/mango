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
	}else{
		$action_requette = "INSERT INTO";
		$last_id = last_id("m_partenaire",$mysql_link);
	}	
	
	// on prépare le nom du fichier
	$nom_fichier = prepare_url(filtre_url(nom_fichier_define($_POST['nom']))); 
	
	
	
	$req = $action_requette." m_partenaire SET ";
	
	$req .= "id =\"".$last_id."\" ";
	$req .= ",id_rubrique =\"".$_POST['id_rubrique']."\" ";
	$req .= ",titre  =\"".addslashes($_POST['titre'])."\" ";
	$req .= ",url  =\"".$_POST['url']."\" ";
	$req .= ",corps  =\"".addslashes($_POST['corps'])."\" ";
	$req .= ",promo  =\"".$_POST["promo"]."\" ";
	
	
	if(!empty($_FILES['userfile1']['name'])){
	
			$nom_fichier_image[1] = prepare_url(filtre_url(nom_fichier_define($_POST['titre']))).'-'.$last_id;
			$fichier_image = upload_fichier("m_partenaire",$_FILES['userfile1']['type'],"www/lib/image/partenariat/",$nom_fichier_image[1],1,$supprimer_image,$last_id);
			$req .= ",userfile1  =\"".$fichier_image."\" ";
	
	}
	
	
	
	
	
	if(!empty($_POST['id'])) $req .= "WHERE id=".$_POST['id'];
	$query = mysqli_query($mysql_link,$req);
	
	//on rérupère les donnees
	$res = donnee("m_partenaire","id",$last_id,"","",$mysql_link);
	
}

?>



<?php require("../../lib/include/n_i-meta.php"); ?>	

<title>Partenariat - Back Office</title>	
		
		
</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Tag - Back Office;</div>
			<div class="content bloc_arrondie">
			<?php echo $ariane = fil_ariance("admin","../","Tag","index.php?id_rubrique=".$_GET['id_rubrique'],"Visualiser","","",""); ?>


			<h1><?php echo stripslashes($res['titre']); ?></h1>
			
				<div class="alingJ clearB">
			
				<?php if(!empty($res['userfile1'])) echo $image = image($res['userfile1'],"right","","","","partenariat","",""); ?>

				<p>
				<?php if(!empty($res['corps']))echo stripslashes(nl2br($res['corps'])); ?>
				<br /><br />
				<?php echo stripslashes($res['url']); ?>
				</p>
				
				
				
				</div>	
				<section class="grid mt2">
					<div class="grid2">
						<div><div class="bouton txtcenter"><a class="fontWhite" href="ajout.php?id_rubrique=23&id=<?php echo $res['id']; ?>" title="Modifier">Modifier</a></div></div>
						<div><div class="bouton txtcenter"><a class="fontWhite" href="index.php?id_rubrique=23" title="Valider">Valider</a></div></div>
					</div>
				</section>		
			
				
			
			</div>
			
		</div>
			
<?php require("../../lib/include/n_i-footer.php") ?>	
	

</div>
</body>

</html>