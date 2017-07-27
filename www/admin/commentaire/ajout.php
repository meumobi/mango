<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/f-formulaire.php");
require("../../lib/fonction/f-validation-formulaire.php");

$res = donnee("m_commentaire","id",$_GET['id'],$condition2,$valeur2,$mysql_link);

?>



<?php require("../../lib/include/n_i-meta.php") ?>	

<title>Commentaire - Back Office</title>	
</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Commentaire - Back Office</div>
		<div class="content bloc_arrondie">
		<?php echo $ariane = fil_ariance("admin","../","Commentaire","index.php","Modifier","","",""); ?>

		
		<form method="POST" enctype="multipart/form-data" action="visualisation.php" name="edito" id="edito" method="POST" onsubmit="return valid();">
		<?php require("../../lib/formulaire/n_form-commentaire.php"); ?>
		</form>
					
		</div>
	</div>
			
<?php require("../../lib/include/n_i-footer.php") ?>
	

</div>
</body>

</html>