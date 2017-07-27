<?php 

require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");

$no_sky = 1;
$no_photo = 1;

if(!empty($_GET['id_rubrique'])){
	$id_rubrique = $_GET['id_rubrique'];
}else{
	$id_rubrique = 1;
}

//on rérupère les donnees
$res = donnee("m_rubrique","id",$id_rubrique,"","",$mysql_link);

?>



<?php require("../lib/include/n_i-meta.php"); ?>	

<title>Proposer un contenu</title>
<meta name="robots" content="noindex,follow">

		
</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
			
	<?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="titreRubrique line mb1">Proposer un contenu</div>
			<div class="line mb2">
			
			<?php echo fil_ariance("Accueil","../",rubrique($id_rubrique,$mysql_link),"../".cheminrubrique($id_rubrique,$mysql_link),"Proposer un contenu","index.php?id_rubrique=".$id_rubrique,"",""); ?>
		
			<?php echo stripslashes(nl2br($res['info_complementaire'])); ?>
			<br /><br />
			

			
			
			</div>
			
			<?php echo dernierephoto("","",$option2,$valeur2,$option3,$valeur3,"/galerie-photo/",$valeur4,$mysql_link); ?>				

			

			
		</div>
			
	
</div>
	<?php require("../lib/include/n_i-footer.php") ?>

</body>

</html>