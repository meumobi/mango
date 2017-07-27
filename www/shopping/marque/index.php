<?php 
$rubrique = 15;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/n_f-pager.php");



//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 1)){
	$p = 1;
}else{
	$p = $_GET['p'];
} 
$par_page = 34;


$req = "SELECT * FROM m_tag WHERE id_cat = 32 AND en_ligne=1 ORDER BY nom ASC LIMIT ".(($p-1)*$par_page).",".$par_page;
$query = mysqli_query($mysql_link,$req);
$nbr_marque = mysqli_num_rows($query);

$req_introduction = "SELECT titre, presentation FROM m_rubrique WHERE id = 21";
$query_introduction = mysqli_query($mysql_link,$req_introduction);
$res_introduction = mysqli_fetch_array($query_introduction);	


?>



<?php require("../../lib/include/n_i-meta.php"); ?>	

<title>Marque de surf</title>
<meta name="description" content="<?php echo strip_tags($res_introduction['presentation']);?>" />
<meta name="robots" content="<?php echo $google_index; ?>">

</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">


	<?php require("../../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="titreRubrique line mb1"><?php echo rubrique(15,$mysql_link); ?></div>
			<div>
			
			<?php echo fil_ariance("Accueil","../../../",rubrique(15,$mysql_link),"../",rubrique(21,$mysql_link),".","",""); ?>
			<div class="line bgGrisClair pa2 mb2 phone-hidden">
			<h1 class="h2-like m-reset"><?php echo $res_introduction['titre']; ?></h1>
				<?php echo $res_introduction['presentation'];?>
			</div>	

			
			
			<?php 
			
			$i = "";
			while ($res = mysqli_fetch_array($query)){ 
				echo listing_marque($res['id'],$i,"90","90",$nbr_marque,$mysql_link);
				$i++;
			} 
			
			?>
			<?php	
			//Pager
			$exist = nbrcontent("m_tag","id_cat","32","en_ligne","1","",$mysql_link);
			echo $pager = pager($exist,$par_page,$p,"","","","",$param3,$valeur3,$param4,$valeur4,$param5,$valeur5); 
			?>

			</div>
			
		</div>
			
	<?php require("../../lib/include/n_i-footer.php") ?>


</div>
</body>

</html>