<?php 
$rubrique = 15;

require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/n_f-pager.php");

//Pour ne pas afficher le bloc photo + sky + business dans la sideBar
$no_photo = 1;
$no_sky = 1;



//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 1)){
	$p = 1;
}else{
	$p = $_GET['p'];
} 
$par_page = 26;

//WHERE id_cat=".$_GET['id']."
$req = "SELECT * FROM m_shopping ORDER BY id DESC LIMIT ".(($p-1)*$par_page).",".$par_page;
$query = mysqli_query($mysql_link,$req);
$nbr_shopping = mysqli_num_rows($query);


$req_introduction = "SELECT titre, presentation FROM m_rubrique WHERE id= 15";
$query_introduction = mysqli_query($mysql_link,$req_introduction);
$res_introduction = mysqli_fetch_array($query_introduction);

?>



<?php require("../lib/include/n_i-meta.php"); ?>	

<title><?php echo categorie($_GET['id']); ?></title>
<meta name="description" content="<?php echo $res_introduction['presentation'];?>" />

		
</head>

<body>

<div class="wSite">

	<?php require("../lib/include/n_i-header.php"); ?>	
	
	<?php 
	
	if ( (empty($_GET['p'])) || ($_GET['p'] == 0) || ($_GET['p'] == 1)){

		echo '<div class="phone-hidden">'.shopping_une2($id_shopping,$rand,$mysql_link).'</div>';
	}
	
	?> 

	
	
	

	<?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="titreRubrique line mb1"><?php echo rubrique(15,$mysql_link); ?></div>
			<div>
			
			<?php echo fil_ariance("Accueil","../",rubrique(15,$mysql_link),".",categorie($_GET['id'],$mysql_link),UrlCategorie($_GET['id'],$mysql_link).'-'.$_GET['id'].'-1.html',"",""); ?>
			<div class="line bgGrisClair pa2 mb2 phone-hidden">
				<h1 class="h2-like m-reset"><?php echo $res_introduction['titre']; ?></h1>
				<?php echo $res_introduction['presentation'];?><br />
			</div>

			
			<?php 
			
			$i = "";
			while ($res = mysqli_fetch_array($query)){ 
				echo listing_shopping($res['id'],$i,$nbr_shopping,"",$mysql_link);
				$i++;
			} 
			
			?>
			<?php	
			
			//Pager
			$exist = nbrcontent("m_shopping","id_rubrique","15","id_cat",$_GET['id'],"",$mysql_link);
			echo $pager = pager($exist,$par_page,$p,"","","keyword",$_GET['keyword'],$param3,$valeur3,$param4,$valeur4,$param5,$valeur5);				
			?>

			</div>
			
		</div>
			
	<?php require("../lib/include/n_i-footer.php") ?>	


</div>
</body>

</html>