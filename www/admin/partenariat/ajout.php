<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/f-formulaire.php");
require("../../lib/fonction/f-validation-formulaire.php");

$req_form = "SELECT nom, formulaire, validation_formulaire FROM m_rubrique WHERE id=".$_GET['id_rubrique'];
$query_form = mysqli_query($mysql_link,$req_form);
$res_form = mysqli_fetch_array($query_form);

if(!empty($_GET['id'])){

	$res = donnee("m_partenaire","id",$_GET['id'],$condition2,$valeur2,$mysql_link);

}
?>



<?php require("../../lib/include/n_i-meta.php") ?>	

<title>-- Ajouter : <?php echo $res_form['nom']; ?>  --</title>	

<?php require("../../lib/formulaire/".$res_form['validation_formulaire']); ?>

</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">-- Ajouter : <?php echo $res_form['nom']; ?>  --</div>
		<div class="content bloc_arrondie">
		
		<form method="POST" enctype="multipart/form-data" action="visualisation.php" name="edito" id="edito" method="POST" onsubmit="return valid();">
		<?php require("../../lib/formulaire/n_".$res_form["formulaire"]); ?>
		</form>
					
		</div>
	</div>
			
<?php require("../../lib/include/n_i-footer.php") ?>	
	

</div>
</body>

</html>