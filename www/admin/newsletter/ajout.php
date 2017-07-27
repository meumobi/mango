<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/f-formulaire.php");
require("../../lib/fonction/f-validation-formulaire.php");

if(!empty($_GET['id'])){
	$res = donnee("m_newsletter","id",$_GET['id'],$condition2,$valeur2,$mysql_link);
}

?>



<?php require("../../lib/include/n_i-meta.php") ?>	

<title>-- Ajouter : une newsletter  --</title>	

</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Newsletter - Back Office</div>
		<div class="content bloc_arrondie">
		
		<form method="POST" enctype="multipart/form-data" action="visualisation.php" name="edito" id="edito" method="POST" onsubmit="return valid();">
		<?php require("../../lib/formulaire/n_form-newsletter.php"); ?>
		</form>
					
		</div>
	</div>
			
<?php require("../../lib/include/n_i-footer.php") ?>	
	

</div>
</body>

</html>