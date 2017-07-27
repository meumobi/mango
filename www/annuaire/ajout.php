<?php 
$rubrique = 14;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/f-formulaire.php");
require("../lib/fonction/f-validation-formulaire.php");

$no_sky = 1;
$no_photo = 1;


if(!empty($_POST['id'])){
	$res = donnee("m_annuaire","id",$_POST['id'],$condition2,$valeur2,$mysql_link);
	$date_publication = dateformat($res["date_publication"],"en","fr");

}else{
	$date_publication = dateformat("","fr","fr");
}


$internaute = true;

?>



<?php require("../lib/include/n_i-meta.php") ?>	

<title>Ajouter votre business</title>	
<meta name="robots" content="noindex">
<?php require("../lib/formulaire/validation-annuaire.php"); ?>

</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">


	<?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1"><?php echo rubrique(14,$mysql_link); ?></div>
		<div class="line">
		
		<form method="POST" enctype="multipart/form-data" action="visualisation.php" name="edito" id="edito" method="POST" onsubmit="return valid();">
		<?php require("../lib/formulaire/n_form-annuaire.php"); ?>
		</form>
					
		</div>
	</div>
			
	<?php require("../lib/include/n_i-footer.php") ?>	
	

</div>
</body>

</html>