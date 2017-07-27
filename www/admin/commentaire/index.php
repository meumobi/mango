<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/n_f-pager.php");



// Supprime la news
if ($_GET['supp'] == 1){
	$req = "DELETE FROM m_commentaire WHERE id = ".$_GET['id'];
	$query = mysqli_query($mysql_link,$req);
}


//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 0)) $p = 1; else $p = $_GET['p'];
$par_page = 30;

$req = "SELECT * FROM m_commentaire WHERE etat = ".$_GET['etat']." ORDER BY id DESC LIMIT ".(($p-1)*$par_page).",".$par_page;
$query = mysqli_query($mysql_link,$req);

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
	<?php echo $ariane = fil_ariance("admin","../","Commentaire","","","","",""); ?>

	
	<?php 
	$i="";
	while ($res = mysqli_fetch_array($query)){ 
		
		if($i%2 != 1)$classimpaire = "bggrisclair";

	?>
	
	<div class="line zebre pa1">
	
		<div class="left"><?php echo substr($res['nom'],0,80); ?></div>
		<div class="right">
		
		<a href="../../<? echo urlFichier($res['id_contenu'],$res['id_rubrique'],$mysql_link); ?>" title="voir" target="_blank"><img src="/lib/image/template/a-voir.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" alt="voir" /></a>
		<a href="ajout.php?id=<?php echo $res['id']; ?>" title="Modifier"><img src="/lib/image/template/a-modifier.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" alt="modifier" /></a>
		<a onClick="if (confirm('Etes vous certain de vouloir suprimer ! ')) document.location.href='index.php?supp=1&etat=<? echo $_GET["etat"]; ?>&id=<? echo $res["id"]; ?>'; else return false;" href="#"><img src="/lib/image/template/a-supprimer.png" alt="supprimer" class="ImgNoBorder" height="20" width="20" valign="middle" /></a>
		</div>
	</div>
	
	
	<?php } ?>

	
	
	<?php 
	
	//on compte le nombre de ligne
	$exist = nbrcontent("m_commentaire","etat",$_GET['etat'],"","","",$mysql_link);
	echo $pager = pager($exist,$par_page,$p,"etat",$_GET['etat'],$param2,$valeur2,$param3,$valeur3,$param4,$valeur4,$param5,$valeur5); 
	
	
	?>
	</div>
	
				
	</div>
		<?php require("../../lib/include/n_i-footer.php") ?>

	</div>
			


</div>
</body>

</html>