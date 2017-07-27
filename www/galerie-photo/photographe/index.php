<?php 
$rubrique = 17;
require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/n_f-pager.php");



//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 1)){
	$p = 1;
}else{
	$p = $_GET['p'];
} 
$par_page = 32;


$req = "SELECT * FROM m_tag WHERE id_cat = 33 AND en_ligne=1 ORDER BY nom ASC LIMIT ".(($p-1)*$par_page).",".$par_page;
$query = mysqli_query($mysql_link,$req);

$req_introduction = "SELECT titre, presentation FROM m_rubrique WHERE id = 20";
$query_introduction = mysqli_query($mysql_link,$req_introduction);
$res_introduction = mysqli_fetch_array($query_introduction);	


?>



<?php require("../../lib/include/n_i-meta.php"); ?>	

<title>Les photographes de surf</title>
<meta name="description" content="<?php echo strip_tags($res_introduction['presentation']);?>" />
</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">
			
	<?php require("../../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="titreRubrique line mb1"><?php echo rubrique(17,$mysql_link); ?></div>
			<div class="line">
			
			<?php echo fil_ariance("Accueil","../../../",rubrique(17,$mysql_link),"../",rubrique(20,$mysql_link),".","",""); ?>
			<div class="line bgGrisClair pa2 mb2 phone-hidden">
			<h1 class="h2-like"><?php echo $res_introduction['titre']; ?></h1>
				<?php echo $res_introduction['presentation'];?>
			</div>	
			
			<?php 
			
			$i = "";
			while ($res = mysqli_fetch_array($query)){ 
				echo listing_photo($res['id'],$i,$res['id'],"90","90","1","",$mysql_link);
				$i++;
			} 
			
			?>
			
			<?php	
			//Pager
			$exist = nbrcontent("m_tag","id_cat","33","en_ligne","1","",$mysql_link);
			echo $pager = pager($exist,$par_page,$p,"","","","",$param3,$valeur3,$param4,$valeur4,$param5,$valeur5); 
			?>

			</div>
			
		</div>
			
	<?php require("../../lib/include/n_i-footer.php") ?>


</div>
</body>

</html>