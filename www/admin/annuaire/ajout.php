<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/f-formulaire.php");
require("../../lib/fonction/f-validation-formulaire.php");

$req_form = "SELECT nom, formulaire, validation_formulaire FROM m_rubrique WHERE id=14";
$query_form = mysqli_query($mysql_link,$req_form);
$res_form = mysqli_fetch_array($query_form);

if(!empty($_GET['id'])){

	$res = donnee("m_annuaire","id",$_GET['id'],$condition2,$valeur2,$mysql_link);
	
	if($res["date_debut"] != "00/00/0000"){
		$date_debut = dateformat($res["date_debut"],"en","fr");
		$date_fin = dateformat($res["date_fin"],"en","fr");
	}

}

?>



<?php require("../../lib/include/n_i-meta.php") ?>	

<title>Annuaire - Back Office</title>	
<link rel="stylesheet" href="../../lib/js/jquery/css/smoothness/jquery-ui-1.8.17.custom.css" type="text/css" media="all" />
<script src="../../lib/js/jquery/js/jquery-min.js" type="text/javascript"></script>
<script src="../../lib/js/jquery/js/jquery-ui-min.js" type="text/javascript"></script>
<script src="../../lib/js/jquery/js/jquery.ui.datepicker-fr.js" type="text/javascript"></script>

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

<?php require("../../lib/formulaire/".$res_form['validation_formulaire']); ?>

</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Annuaire - Back Office</div>
		<div class="content bloc_arrondie">
		<?php echo $ariane = fil_ariance("admin","../","Annuaire ".categorie($_GET['id_cat']),"index.php?id_cat=".$_GET['id_cat'],"Ajouter / Modifier","","",""); ?>

		
		<form method="POST" enctype="multipart/form-data" action="visualisation.php" name="edito" id="edito" method="POST" onsubmit="return valid();">
		<?php require("../../lib/formulaire/n_".$res_form["formulaire"]); ?>
		</form>
					
		</div>
	</div>
			
	
<?php require("../../lib/include/n_i-footer.php") ?>	
</div>
</body>

</html>