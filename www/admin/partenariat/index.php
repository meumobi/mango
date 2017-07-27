<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/n_f-pager.php");
require("../../lib/fonction/f-formulaire.php");


// Supprime la news
if ($_GET['supp'] == 1){
	$req = "DELETE FROM m_partenaire WHERE id = ".$_GET['id'];
	$query = mysqli_query($mysql_link,$req);
}


//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 0)) $p = 1; else $p = $_GET['p'];
$par_page = 31;

$req_tag = "SELECT * FROM m_partenaire ORDER BY id DESC LIMIT ".(($p-1)*$par_page).",".$par_page;
$query_tag = mysqli_query($mysql_link,$req_tag);

?>



<?php require("../../lib/include/n_i-meta.php") ?>	

<title>Partenariat - Back Office</title>	
</head>
	
<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Partenariat - Back Office</div>
	<div class="content bloc_arrondie">
	<?php echo $ariane = fil_ariance("admin","../","Partenariat","index.php?id_rubrique=23","","","",""); ?>
	

	<div class="line bouton txtcenter mb2"><a class="fontWhite" href="ajout.php?id_rubrique=23" title="Ajouter un produit">Ajouter un Partenaire</a></div>

	
	
	
	
	
	<?php
	
	$i="";
	while ($res_tag = mysqli_fetch_array($query_tag)){ 
	
	
	?>
	<div class="line zebre pa1">

		<div class="left"><?php echo substr($res_tag['titre'],0,80); ?></div>
			<div class="right">
			
			<a href="../../partenaire/" target="_blank"><img src="/lib/image/template/a-voir.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" alt="voir" /></a>
			
			<a href="ajout.php?id=<?php echo $res_tag['id']; ?>&id_rubrique=23" title="Modifier"><img src="/lib/image/template/a-modifier.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" alt="modifier" /></a>
			<a onClick="if (confirm('Etes vous certain de vouloir suprimer ! ')) document.location.href='index.php?supp=1&id=<? echo $res_tag["id"]; ?>&id_rubrique=23'; else return false;" href="#"><img src="/lib/image/template/a-supprimer.png" alt="supprimer" class="ImgNoBorder" height="20" width="20" valign="middle" /></a>
		</div>
	
	</div>
	<?php } ?>

	
	
	<?php 
	
	//on compte le nombre de ligne
	$exist = nbrcontent("m_partenaire","id_rubrique",23,"","","",$mysql_link);
	echo $pager = pager($exist,$par_page,$p,"id_rubrique",23,"","","","","","","",""); 

	
	?>
	</div>
	
				
	</div>
	</div>
			
	<?php require("../../lib/include/n_i-footer.php") ?>	
	

</div>
</body>

</html>