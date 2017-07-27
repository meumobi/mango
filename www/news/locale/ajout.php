<?php 
$rubrique = 7;
require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/f-formulaire.php");
require("../../lib/fonction/f-validation-formulaire.php");

$no_sky = 1;
$no_photo = 1;


$internaute = true;

$req_form = "SELECT nom, formulaire, validation_formulaire FROM m_rubrique WHERE id=7";
$query_form = mysqli_query($mysql_link,$req_form);
$res_form = mysqli_fetch_array($query_form);

if(!empty($_POST['id'])){

	$res = donnee("m_editorial","id",$_POST['id'],$condition2,$valeur2,$mysql_link);
	$date_publication = dateformat($res["date_publication"],"en","fr");

}else{
	$date_publication = dateformat("","fr","fr");
}

?>



<?php require("../../lib/include/n_i-meta.php") ?>	

<title>Ajouter une actualité locale</title>	

<?php require("../../lib/formulaire/".$res_form['validation_formulaire']); ?>
<meta name="robots" content="noindex">
</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">


	<?php require("../../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1"><?php echo rubrique(7,$mysql_link); ?></div>
		<div class="line">
		
		<form method="POST" enctype="multipart/form-data" action="visualisation.php" name="edito" id="edito" method="POST" onsubmit="return valid();">
		<?php require("../../lib/formulaire/n_".$res_form["formulaire"]); ?>
		</form>
					
		</div>
	</div>
			
	<?php require("../../lib/include/n_i-footer.php") ?>	
	

</div>
</body>

</html>