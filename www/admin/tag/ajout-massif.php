<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/f-formulaire.php");
require("../../lib/fonction/f-validation-formulaire.php");
?>



<?php require("../../lib/include/n_i-meta.php") ?>	

<title>-- Ajouter : Tag</title>	

<?php require("../../lib/formulaire/validation-tag-massif.php"); ?>

</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Ajout massif de tag </div>
		<div class="content bloc_arrondie">
		
		<form method="POST" enctype="multipart/form-data" action="visualisation-massif.php" name="edito" id="edito" method="POST" onsubmit="return valid();">
		<?php require("../../lib/formulaire/n_form-tag-massif.php"); ?>
		</form>
					
		</div>
	</div>
			
<?php require("../../lib/include/n_i-footer.php") ?>	
	

</div>
</body>

</html>