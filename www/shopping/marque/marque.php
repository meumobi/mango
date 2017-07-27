<?php 
$rubrique = 15;

$no_sky = 1;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/n_f-pager.php");



//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 1)){
	$google_index = "index, follow";
	$p = 1;
}else{
	$google_index = "noindex, follow";
	$p = $_GET['p'];
} 
$par_page = 17;


$req = "SELECT * FROM m_shopping WHERE id_marque = ".$_GET['id']." ORDER BY id DESC LIMIT ".(($p-1)*$par_page).",".$par_page;
$query = mysqli_query($mysql_link,$req);
$nbr_shopping = mysqli_num_rows($query);

$req_introduction = "SELECT corps FROM m_tag WHERE id=".$_GET['id'];
$query_introduction = mysqli_query($mysql_link,$req_introduction);
$res_introduction = mysqli_fetch_array($query_introduction);


?>



<?php require("../../lib/include/n_i-meta.php"); ?>	

<title><?php echo marque($_GET['id'],$mysql_link) ?></title>
<meta name="description" content="Découvrez tous les produits de la marque <?php echo marque($_GET['id'],$mysql_link) ?>. <?php echo tronquer($res_introduction['corps'],255);?>" />
<meta name="robots" content="<?php echo $google_index; ?>">

		
</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">


	<?php require("../../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="titreRubrique line mb1"><?php echo rubrique(15,$mysql_link); ?></div>
			<div class="content bloc_arrondie">
			
			<?php echo fil_ariance("Accueil","../../",rubrique(15,$mysql_link),"../",rubrique(21,$mysql_link),".",marque($_GET['id'],$mysql_link),Urlmarque($_GET['id'],$mysql_link).'-'.$_GET['id'].'-1.html'); ?>
		
			<div class="overflow mrgT20 mrgB20 pad10" id="introduction">
				<h1 class="accroche"><?php echo marque($_GET['id'],$mysql_link); ?></h1>
				<?php echo $res_introduction['corps'];?>
			</div>

			
			
			<?php 
			
			$i = "";
			while ($res = mysqli_fetch_array($query)){ 
				echo listing_shopping($res['id'],$i,$nbr_shopping,"1",$mysql_link);
				$i++;
			} 
			
			?>
			
			<?php	
			//Pager
			$exist = nbrcontent("m_shopping","id_marque",$_GET['id'],"","","",$mysql_link);
			echo $pager = pager_rewriting($exist,$par_page,$_GET['p'],Urlmarque($_GET['id'],$mysql_link),$_GET['id'],"",""); 
			?>

			</div>
			
		</div>
			
	
	<?php require("../../lib/include/n_i-footer.php") ?>

</div>
</body>

</html>