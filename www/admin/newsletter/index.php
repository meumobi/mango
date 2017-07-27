<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/f-all.php");
require("../../lib/fonction/n_f-pager.php");
require("../../lib/fonction/f-formulaire.php");


// Supprime la news
if ($_GET['supp'] == 1){
	$req = "DELETE FROM m_newsletter WHERE id = ".$_GET['id'];
	$query = mysqli_query($mysql_link,$req);
}


//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 0)) $p = 1; else $p = $_GET['p'];
$par_page = 31;

$req_newsletter = "SELECT * FROM m_newsletter ORDER BY id DESC LIMIT ".(($p-1)*$par_page).",".$par_page;
$query_newsletter = mysqli_query($mysql_link,$req_newsletter);

?>



<?php require("../../lib/include/n_i-meta.php") ?>	

<title>Newsletter - Back Office</title>	
</head>
	
<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Newsletter - Back Office</div>
	<div class="content bloc_arrondie">
	<?php echo $ariane = fil_ariance("admin","../","Newsletter","index.php","","","",""); ?>
	
	<div class="line bouton txtcenter mb2"><a class="fontWhite" href="ajout.php" title="Ajouter un produit">Ajouter une Newsletter</a></div>

	
	<?php
	
	$i="";
	while ($res_newsletter = mysqli_fetch_array($query_newsletter)){ 
	
	
	?>
	<div class="line zebre pa1">

		<div class="left"><?php echo dateformat($res["date_ajout"],"en","fr"); ?> - Newsletter N° <?php echo $res_newsletter['id']; ?></div>
			<div class="right">
			
			<a href="../../corporate/n_newsletter.php?id=<?php echo $res_newsletter['id']; ?>" target="_blank"><img src="/lib/image/template/a-voir.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" alt="voir" /></a> HTML 
			<a href="../../corporate/newsletter-texte.php?id=<?php echo $res_newsletter['id']; ?>" target="_blank"><img src="/lib/image/template/a-voir.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" alt="voir" /></a> TXT
		
			<a href="ajout.php?id=<?php echo $res_newsletter['id']; ?>" title="Modifier"><img src="/lib/image/template/a-modifier.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" alt="modifier" /></a>
			<a onClick="if (confirm('Etes vous certain de vouloir suprimer ! ')) document.location.href='index.php?supp=1&id=<? echo $res_newsletter["id"]; ?>'; else return false;" href="#"><img src="/lib/image/template/a-supprimer.png" alt="supprimer" class="ImgNoBorder" height="20" width="20" valign="middle" /></a>
		</div>
	
	</div>
	<?php $i++; $classimpaire=""; } ?>

	
	
	<?php 
	
	//on compte le nombre de ligne
	$exist = nbrcontent("m_newsletter","","","","",$param_pager,$mysql_link);
	echo $pager = pager($exist,$par_page,$p,"","","","","","","","","",""); 

	
	?>
	</div>
	
				
	</div>
	</div>
			
	<?php require("../../lib/include/n_i-footer.php") ?>	


</div>
</body>

</html>