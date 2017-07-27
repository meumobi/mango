<?php 
$rubrique = 14;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/n_f-pager.php");


$no_sky=1;

//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 1)){
	$p = 1;
}else{
	$p = $_GET['p'];
} 
$par_page = 30;

$req = "SELECT * FROM m_annuaire WHERE id_rubrique= 14 AND en_ligne = 1 AND id_cat=".$_GET['id']; 

if((!empty($_GET['r'])) AND ($_GET['r'] != 0) AND ($_GET['id'] != 29)){
	$req .= " AND id_region = ".$_GET['r'];
	$champ_localisation = "id_region";
	$fil_ariane = region($_GET['r'],$mysql_link);
	
}elseif( (!empty($_GET['r'])) AND ($_GET['r'] != 0) ){
	$req .= " AND id_pays = ".$_GET['r'];
	$champ_localisation = "id_pays";
	$fil_ariane = pays($_GET['r'],$mysql_link);
}

$req .= " ORDER BY titre ASC LIMIT ".(($p-1)*$par_page).",".$par_page;
$query = mysqli_query($mysql_link,$req);
$nbr_annuaire = mysqli_num_rows($query);

$req_introduction = "SELECT nom,presentation_longue FROM m_cat WHERE id=".$_GET['id'];
$query_introduction = mysqli_query($mysql_link,$req_introduction);
$res_introduction = mysqli_fetch_array($query_introduction);

?>



<?php require("../lib/include/n_i-meta.php"); ?>	

<title><?php echo categorie($_GET['id'],$mysql_link)." ".region($_GET['r'],$mysql_link); ?></title>

<meta name="description" content="<?php echo strip_tags($res_introduction['presentation_longue']);?>" />

<script language="JavaScript">
function ChangeUrl(formulaire){
	if (formulaire.region.selectedIndex != 0){
		location.href = formulaire.region.options[formulaire.region.selectedIndex].value;
	}else{
		alert('Veuillez choisir une destination.');
	}
}
</script>

</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
    <?php echo fil_ariance("Accueil","../",rubrique(14,$mysql_link),".",categorie($_GET['id'],$mysql_link),DossierCategorie($_GET['id'],$mysql_link).'-'.$_GET['id'].'-0-1.html',$fil_ariane,""); ?>

    <?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="line">
			

			<section class="line bgGrisClair pa2 mb2 phone-hidden grid">
				<div class="grid2">			
				<div>
					<h1 class="h2-like m-reset"><?php echo $res_introduction['nom']." ".$fil_ariane; ?></h1>
					<?php echo $res_introduction['presentation_longue'];?><br />
				</div>
				
				<div>
					<h1 class="h2-like m-reset">Filtrer par région</h1>
					<div>Vous pouvez filtrer les fiches présentes dans l'annuaire par région / pays à partir du formulaire ci-dessous.</div>
					<form name="formulaire" id="formulaire"><?php echo menu_region("m_annuaire","",$_GET['id'],$_GET['r'],$_GET['p'],$mysql_link); ?></form>
				</div>
				</div>
			</section>
			
			<div class="bouton txtcenter mb2"><a class="fontWhite" href="ajout.php?id_cat=<?php echo $_GET['id'];?>" title="Ajouter votre entreprise" rel="nofollow">Ajouter votre <?php echo categorie($_GET['id'],$mysql_link); ?></a></div>
			
			<?php 
			
			$i = "";
			while ($res = mysqli_fetch_array($query)){ 
							
				echo listing_annuaire($res['id'],$i,$nbr_annuaire,$mysql_link);
			$i++;
			} 
			
			?>
			
			<?php
				
			//Pager
			$exist = nbrcontent("m_annuaire","id_cat",$_GET['id'],$champ_localisation,$_GET['r'],"",$mysql_link);
			echo $pager = pager_rewriting($exist,$par_page,$_GET['p'],UrlCategorie($_GET['id'],$mysql_link),$_GET['id'],"",$_GET['r']); 
			
			?>

			</div>
			
		</div>
			
	<?php require("../lib/include/n_i-footer.php") ?>	

</div>
</body>

</html>