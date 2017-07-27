<?php 
$rubrique = 16;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/f-formulaire.php");
require("../lib/fonction/f-validation-formulaire.php");


$no_sky = 1;
$no_photo = 1;


if(!empty($_POST['id'])){

	$res = donnee("m_agenda","id",$_POST['id'],$condition2,$valeur2,$mysql_link);
	
	$date_debut = dateformat($res["date_debut"],"en","fr","/");
	$date_fin = dateformat($res["date_fin"],"en","fr","/");
}

$internaute = true;

?>


<?php require("../lib/include/n_i-meta.php") ?>	
<?php require("../lib/formulaire/validation-agenda.php"); ?>
<title>Ajouter une manifestation</title>	
<meta name="robots" content="noindex">



<link rel="stylesheet" href="../lib/js/jquery/css/smoothness/jquery-ui-1.8.17.custom.css" type="text/css" media="all" />
<script src="../lib/js/jquery/js/jquery-min.js" type="text/javascript"></script>
<script src="../lib/js/jquery/js/jquery-ui-min.js" type="text/javascript"></script>
<script src="../lib/js/jquery/js/jquery.ui.datepicker-fr.js" type="text/javascript"></script>

<script>
$(function() {
	$.datepicker.setDefaults( $.datepicker.regional[ "" ] );
	
	
	$( "#format" ).change(function() {
			$( "#date_debut" ).datepicker( "option", "dateFormat", $( this ).val('') );
	});	
	
	$( "#date_debut" ).datepicker( $.datepicker.regional[ "fr" ] );
	$( "#locale" ).change(function() {
		$( "#date_debut" ).datepicker( "option",
			$.datepicker.regional[ $( this ).val() ] );
	});
});

$(function() {
	$.datepicker.setDefaults( $.datepicker.regional[ "" ] );
	$( "#date_fin" ).datepicker( $.datepicker.regional[ "fr" ] );
	$( "#locale" ).change(function() {
		$( "#date_fin" ).datepicker( "option",
			$.datepicker.regional[ $( this ).val() ] );
	});
});
</script>



</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">


	<?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1"><?php echo rubrique(16,$mysql_link); ?></div>
		<div>
			<form method="POST" enctype="multipart/form-data" action="visualisation.php" name="edito" id="edito" method="POST" onsubmit="return valid();">
			<?php require("../lib/formulaire/n_form-agenda.php"); ?>
			</form>
					
		</div>
	</div>
			
<?php require("../lib/include/n_i-footer.php") ?>


</div>
</body>

</html>