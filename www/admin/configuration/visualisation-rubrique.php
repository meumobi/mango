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
		$last_id = last_id("m_tag",$mysql_link);
	}	
	
	
	$req = $action_requette." m_rubrique SET ";
	
	$req .= "id =\"".$last_id."\" ";
	$req .= ",nom =\"".$_POST['nom']."\" ";
	$req .= ",chemin =\"".$_POST['chemin']."\" ";
	$req .= ",old_chemin  =\"".$_POST['old_chemin']."\" ";
	$req .= ",titre  =\"".addslashes($_POST['titre'])."\" ";
	$req .= ",presentation  =\"".addslashes($_POST["presentation"])."\" ";
	$req .= ",info_complementaire  =\"".addslashes($_POST["info_complementaire"])."\" ";
	$req .= ",formulaire  =\"".$_POST["formulaire"]."\" ";
	$req .= ",validation_formulaire  =\"".$_POST["validation_formulaire"]."\" ";
	
	if(!empty($_POST['id'])) $req .= "WHERE id=".$_POST['id'];
	
	$query = mysqli_query($mysql_link,$req);
	
	//on rérupère les donnees
	$res = donnee("m_rubrique","id",$last_id,"","",$mysql_link);
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
		
		<div class="titreRubrique line mb1">Configuration du site - Back Office</div>
			<div class="content bloc_arrondie">
			<?php echo $ariane = fil_ariance("admin","../","configuration du site","index.php","Visualiser","","",""); ?>

			
			<h1><?php echo stripslashes($res['nom']); ?></h1>
			
				<div class="alingJ clearB">
				<p>
					<?php echo stripslashes($res['chemin']); ?><br />
					<?php echo stripslashes($res['old_chemin']); ?><br />
					<?php echo stripslashes($res['formulaire']); ?><br />
					<?php echo stripslashes($res['validation_formulaire']); ?><br /><br />
					
					<strong><?php echo stripslashes($res['titre']); ?></strong><br /><br />
					<?php echo stripslashes($res['presentation']); ?>
					<br /><br />------------------------------------------------------------------------------------<br />
					<?php echo nl2br($res['info_complementaire']); ?><br /><br />

					
				
				
				
				</p>
				
				</div>
				
				
				
					
				<section class="grid mt2">
					<div class="grid2">
						<div><div class="bouton txtcenter"><a class="fontWhite" href="ajout-rubrique.php?id_rubrique=<?php echo $res['id_rubrique']; ?>&id=<?php echo $res['id']; ?>" title="Modifier">Modifier</a></div></div>
						<div><div class="bouton txtcenter"><a class="fontWhite" href="index.php?id_rubrique=<?php echo $res['id_rubrique']; ?>" title="Valider">Valider</a></div></div>
					</div>
				</section>

			
				
			
			</div>
			
		</div>
			
<?php require("../../lib/include/n_i-footer.php") ?>	
	

</div>
</body>

</html>