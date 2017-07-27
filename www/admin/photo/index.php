<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/n_f-pager.php");
require("../../lib/fonction/f-formulaire.php");



// Supprime la news
if ($_GET['supp'] == 1){
	$req = "DELETE FROM m_photo WHERE id = ".$_GET['id'];
	$query = mysqli_query($mysql_link,$req);
}


//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 0)) $p = 1; else $p = $_GET['p'];
$par_page = 30;


$req_photo = "SELECT * FROM m_photo WHERE id_rubrique=".$_GET['id_rubrique'];


$param_pager ="";

if(!empty($_GET['identifiant'])){
	$req_photo .= " AND id = ".$_GET['identifiant'];
	$param_pager .= " AND id = ".$_GET['identifiant'];
}

if(!empty($_GET['mot_cle'])){
	$req_photo .= " AND legende like '%".$_GET['mot_cle']."%'";
	$param_pager .= " AND legende like '%".$_GET['mot_cle']."%'";
}

if(!empty($_GET['id_cat'])){
	$req_photo .= " AND id_cat = ".$_GET['id_cat'];
	$param_pager .= " AND id_cat = ".$_GET['id_cat'];
}

if(!empty($_GET['id_photographe'])){
	$req_photo .= " AND id_photographe = ".$_GET['id_photographe'];
	$param_pager .= " AND id_photographe = ".$_GET['id_photographe'];
}


$req_photo .= " ORDER BY id DESC LIMIT ".(($p-1)*$par_page).",".$par_page;

$query_photo = mysqli_query($mysql_link,$req_photo);
$nbr_photo = mysqli_num_rows($query_photo);

?>



<?php require("../../lib/include/n_i-meta.php") ?>	

<title>Galerie Photo - Back Office</title>	
</head>
	
<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Galerie Photo - Back Office</div>
	<div class="content bloc_arrondie">
	<?php echo $ariane = fil_ariance("admin","../","Galerie Photo","index.php?id_rubrique=".$_GET['id_rubrique'],"","","",""); ?>

	<form method="GET" enctype="multipart/form-data" action="index.php?id_rubrique=<?php echo $_GET['id_rubrique']; ?>" name="admin" id="admin" method="POST" onsubmit="return valid();">
	
	<section class="bgGrisClair line mb2 pa1">
	
		<h1 class="h2-like m-reset">Moteur de recherche</h1>
		<section class="line grid">
			<div class="grid2">
			<?php echo $input = input("Mot clé","mot_cle","text","255",$_POST["mot_cle"],"borderGray w100 pa1","mb1" ); ?>
			<?php echo $input = input("Identifiant","identifiant","text","255",$_POST["identifiant"],"borderGray w100 pa1","mb1"); ?>
			</div>
		</section>
		
		<section class="line grid">
			<div class="grid2">
		<?php 

		$req = "SELECT id,nom FROM m_cat WHERE id_rubrique=17 ORDER BY id";
		$query = mysqli_query($mysql_link,$req);
		
						
		echo $liste = liste("Catégorie<span class='alerte'>*</span>","id_cat",$_GET['id_cat'],$optgroup1,$query,$optgroup2,$query2,"borderGray w100 pa1","mb1"); 
			
		$req = "SELECT id,nom FROM m_tag WHERE id_cat = 33 ORDER BY nom";
		$query = mysqli_query($mysql_link,$req);
					
		echo $liste = liste("Photographe<span class='alerte'>*</span>","id_photographe",$_GET["id_photographe"],$optgroup1,$query,$optgroup2,$query2,"borderGray w100 pa1","mb1");
				
		?>
			</div>
		</section>
		
		<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
		<div class="line txt center"><?php echo $bouton = bouton("Valider","admin","submit","bouton"); ?></div>		
		
	</section>
	</form>
	
	
	
	
	
	<div class="line bouton txtcenter mb2"><a class="fontWhite"  href="ajout.php?id_rubrique=<?php echo $_GET['id_rubrique']; ?>" title="Ajouter une photo">Ajouter une photo</a></div>

	<?php			
	$i = "";
	while ($res_photo = mysqli_fetch_array($query_photo)){ 
							
		echo listing_photo_admin($res_photo['id'],$i,"","150","100",$_GET['mot_cle'],$_GET['identifiant'],$_GET['id_cat'],$_GET['id_photographe'],"",$mysql_link);
		$i++;
	} 
	?>
	
	<?php 
	
	//on compte le nombre de ligne
	
	$exist = nbrcontent("m_photo","id_rubrique",$_GET['id_rubrique'],"","",$param_pager,$mysql_link);
	echo $pager = pager($exist,$par_page,$p,"id_rubrique",$_GET['id_rubrique'],"identifiant",$_GET['identifiant'],"mot_cle",$_GET['mot_cle'],"id_cat",$_GET['id_cat'],"id_photographe",$_GET['id_photographe']); 

	
	?>
	</div>
	
				
	</div>
	</div>
			
	<?php require("../../lib/include/n_i-footer.php") ?>	
	

</div>
</body>

</html>