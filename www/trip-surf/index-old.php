<?php 
$rubrique = 3;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/n_f-pager.php");



//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 0)){
	$p = 1;
}else{
	$p = $_GET['p'];
}

$par_page = 25;


$req = "SELECT * FROM m_editorial WHERE id_rubrique= 3 AND en_ligne = 1 AND date_publication < NOW() ORDER BY date_publication DESC LIMIT ".(($p-1)*$par_page).",".$par_page;
$query = mysqli_query($mysql_link,$req);

$req_introduction = "SELECT titre, presentation FROM m_rubrique WHERE id = 3";
$query_introduction = mysqli_query($mysql_link,$req_introduction);
$res_introduction = mysqli_fetch_array($query_introduction);


?>



<?php require("../lib/include/n_i-meta.php"); ?>	

<title>Trip surf</title>
<meta name="description" content="<?php echo strip_tags($res_introduction['presentation']);?>" />
</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
	
	<?php 
	
	if ((empty($_GET['p'])) || ($_GET['p'] == 0) || ($_GET['p'] == 1)){

		$req_une = "SELECT *, userfile2 AS photo, userfile3 AS photo1 FROM m_editorial WHERE id_rubrique= 3 AND en_ligne = 1 AND date_publication < NOW() ORDER BY date_publication DESC LIMIT 0,4";
		$query_une = mysqli_query($mysql_link,$req_une);

		echo mega_une_2($req_une,$query_une,$mysql_link);
	}
	
	?> 

	
	

	<?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="titreRubrique line mb1"><?php echo rubrique(3,$mysql_link); ?></div>
			<div class="line">
			
			<?php echo fil_ariance("Accueil","../",rubrique(3,$mysql_link),".","","","",""); ?>
			
			<?php
			?>
			
			<div class="line bgGrisClair pa2 mb2 phone-hidden">
				<h1 class="h2-like m-reset"><?php echo $res_introduction['titre']; ?></h1>
				<?php echo $res_introduction['presentation'];?>
			</div>

			<?php 
			
			$i = "";
			while ($res = mysqli_fetch_array($query)){ 
							
				echo listing_classique($res['id'],"../lib/image/editorial/".$res['userfile1'],"../lib/image/editorial/".$res['userfile2'],$res['titre'],$res['chapeau'],"s-".$res['nom_fichier'],$commentaire,$res['date_publication'],$i,"70","120",$id_region,$p,$mysql_link);
				$i++;
			} 
			
			?>
			
			<?php	
			
			//Pager
			$exist = nbrcontent("m_editorial","id_rubrique","3","","","",$mysql_link);
			echo $pager = pager($exist,$par_page,$p,"","",$param2,$valeur2,$param3,$valeur3,$param4,$valeur4,$param5,$valeur5); 
						
			?>

			</div>
			
		</div>
			
	<?php require("../lib/include/n_i-footer.php") ?>	


</div>
</body>

</html>