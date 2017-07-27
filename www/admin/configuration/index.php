<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/f-pager.php");



$req = "SELECT * FROM m_rubrique ORDER BY id ASC";
$query = mysqli_query($mysql_link,$req);

?>



<?php require("../../lib/include/n_i-meta.php") ?>	

<title>Configuration du site - Back Office</title>	
</head>
	
<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Configuration du site - Back Office</div>
	<div class="content bloc_arrondie">
	<?php echo $ariane = fil_ariance("admin","../","configuration du site","index.php","","","",""); ?>

	
	<?php 
	
	$i="";
	while ($res = mysqli_fetch_array($query)){ 
	
		$req_cat = "SELECT * FROM m_cat WHERE id_rubrique = ".$res['id']." ORDER BY id ASC";
		$query_cat = mysqli_query($mysql_link,$req_cat);
		
	?>
	
	
	<div class="line zebre pa1">

		<div class="left"><strong><?php echo substr($res['nom'],0,80); ?></strong></div>
		<div class="right">
			<a href="../../<?php echo $res['chemin']; ?>" title="Voir" target="_blank"><img src="/lib/image/template/a-voir.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" alt="voir" /></a>
			<a href="ajout-rubrique.php?id=<?php echo $res['id']; ?>" title="Modifier"><img src="/lib/image/template/a-modifier.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" alt="modifier" /></a> 
			<a href="ajout-categorie.php?id_rubrique=<?php echo $res['id']; ?>" title="Ajouter"><img src="/lib/image/template/a-ajouter.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" /></a> 
		</div>
	
	</div>
			
			<?php 
			$z="";
			while ($res_cat = mysqli_fetch_array($query_cat)){ 
				if($z%2 != 1)$classimpaire2 = "bggrisclair";
			?>
				<div class="line zebre pa1">
	
					<div class="left"><?php echo substr($res_cat['nom'],0,80); ?></div>
					<div class="right"><a href="ajout-categorie.php?id=<?php echo $res_cat['id']; ?>&id_rubrique=<?php echo $res_cat['id_rubrique']; ?>" title="Modifier"><img src="/lib/image/template/a-modifier.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" alt="modifier" /></a><br /></div>
					
				</div>
	
			
			<?php $z++; $classimpaire2=""; } ?>
		
	
	
	
	<div class="clearB"> </div>
	
	<?php $i++; } ?>

	</div>
	
				
	</div>
	</div>
			
<?php require("../../lib/include/n_i-footer.php") ?>	
	

</div>
</body>

</html>