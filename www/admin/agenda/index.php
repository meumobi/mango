<?php 

$admin=true;


require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/n_f-pager.php");
require("../../lib/fonction/f-formulaire.php");


// Supprime la news
if ($_GET['supp'] == 1){
	$req = "DELETE FROM m_agenda WHERE id = ".$_GET['id'];
	$query = mysqli_query($mysql_link,$req);
}


//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 0)) $p = 1; else $p = $_GET['p'];
$par_page = 31;

$req = "SELECT * FROM m_agenda WHERE id_rubrique=".$_GET['id_rubrique'];

if(!empty($_GET['identifiant'])){
	$req .= " AND id = ".$_GET['identifiant'];
	$param_pager .= " AND id = ".$_GET['identifiant'];
}

if(!empty($_GET['mot_cle'])){
	$req .= " AND titre like '%".$_GET['mot_cle']."%'";
	$param_pager .= " AND titre like '%".$_GET['mot_cle']."%'";
}

if($_GET['en_ligne'] == "2"){
	$req .= " AND en_ligne = 2";
	$param_pager .= " AND en_ligne = 2";
}

$req .= " ORDER BY date_debut DESC LIMIT ".(($p-1)*$par_page).",".$par_page;


$query = mysqli_query($mysql_link,$req);

?>



<?php require("../../lib/include/n_i-meta.php") ?>	

<title>Agenda - Back Office</title>	
</head>
	
<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Agenda - Back Office</div>
	<div class="content bloc_arrondie">
	<?php echo $ariane = fil_ariance("admin","../","Agenda","index.php?id_rubrique=".$_GET['id_rubrique'],"","","",""); ?>
	
	<form method="GET" enctype="multipart/form-data" action="index.php?id_rubrique=<?php echo $_GET['id_rubrique']; ?>" name="admin" id="admin" method="POST" onsubmit="return valid();">
	
	<section class="bgGrisClair line mb2 pa1">
	
		<h1 class="h2-like m-reset">Moteur de recherche</h1>
		<section class="line grid">
			<div class="grid2">
			<?php echo $input = input("Mot clé","mot_cle","text","255",$_POST["mot_cle"],"borderGray w100 pa1","mb1" ); ?>
			<?php echo $input = input("Identifiant","identifiant","text","255",$_POST["identifiant"],"borderGray w100 pa1","mb1"); ?>
			</div>
		</section>
		
		<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
		<div class="line txt center"><?php echo $bouton = bouton("Valider","admin","submit","bouton"); ?></div>		
		
	</section>
	</form>
	<div class="line bouton txtcenter mb2"><a class="fontWhite" href="ajout.php?id_rubrique=16" title="Ajouter une manifestation">Ajouter une manifestation</a></div>

	<section class="mb2">
	<?php 
	
	while ($res = mysqli_fetch_array($query)){ 
	

	
	?>
		<div class="line zebre pa1">
	
		<div class="left"><?php echo '<strong>'.dateformat($res["date_debut"],"en","fr").'</strong> - '.substr($res['titre'],0,65); ?></div>
			<div class="right">
			<a href="/agenda/<?php echo $res['nom_fichier']; ?>--<?php echo $res['id']; ?>.html" target="_blank"><img src="/lib/image/template/a-voir.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" alt="voir" /></a>
			<a href="ajout.php?id=<?php echo $res['id']; ?>&id_rubrique=<?php echo $res['id_rubrique']; ?>" title="Modifier"><img src="/lib/image/template/a-modifier.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" alt="modifier" /></a>
			<a onClick="if (confirm('Etes vous certain de vouloir suprimer ! ')) document.location.href='index.php?supp=1&id=<? echo $res["id"]; ?>&id_rubrique=<?php echo $res['id_rubrique']; ?>'; else return false;" href="#"><img src="/lib/image/template/a-supprimer.png" alt="supprimer" class="ImgNoBorder" height="20" width="20" valign="middle" /></a>
		</div>
	</div>
	
	<?php } ?>

	</section>
	
	<?php 
	
	$exist = nbrcontent("m_agenda","id_rubrique",$_GET['id_rubrique'],"en_ligne",$_GET['en_ligne'],$param_pager,$mysql_link);
	echo $pager = pager($exist,$par_page,$p,"id_rubrique",$_GET['id_rubrique'],"identifiant",$_GET['identifiant'],"mot_cle",$_GET['mot_cle'],"en_ligne",$_GET['en_ligne'],$param5,$valeur5); 

	
	?>
	</div>
	
				
	</div>
	</div>
			
	<?php require("../../lib/include/n_i-footer.php") ?>


</div>
</body>
</html>