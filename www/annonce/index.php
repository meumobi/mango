<?php 
$rubrique = 19;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/n_f-pager.php");

$no_sky=1;
$no_photo=1;

//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 0)){
	$p = 1;
}else{
	$p = $_GET['p'];
} 
$par_page = 18;


$req = "SELECT * FROM m_editorial WHERE id_rubrique= 19 AND en_ligne = 1";
$req .= " ORDER BY date_publication DESC LIMIT ".(($p-1)*$par_page).",".$par_page;

$query = mysqli_query($mysql_link,$req);
$nbr_annonce = mysqli_num_rows($query);


$req_introduction = "SELECT titre, presentation FROM m_rubrique WHERE id= 19";
$query_introduction = mysqli_query($mysql_link,$req_introduction);
$res_introduction = mysqli_fetch_array($query_introduction);

?>



<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">

<title>Les petites annonces de la communauté surf</title>
<meta name="description" content="<?php echo strip_tags($res_introduction['presentation']);?>" />
		
</head>

<body>

<div class="wSite">

	<?php require("../lib/include/n_i-header.php"); ?>	
			
	<?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="titreRubrique line mb1"><?php echo rubrique(19,$mysql_link); ?></div>
			<div class="line">
			
			
			<?php echo fil_ariance("Accueil","../",rubrique(19,$mysql_link),".","","","",""); ?>
			
			<div class="line bgGrisClair pa2 mb2 phone-hidden">
				<h1 class="h2-like m-reset"><?php echo $res_introduction['titre']; ?></h1>
				<?php echo $res_introduction['presentation'];?>
			</div>
			<div class="bouton mb2 txtcenter"><a class="fontWhite" href="ajout.php" title="Poster une annonce" rel="nofollow">Poster une annonce</a></div>
			<?php 
			
			$i = "";
			while ($res = mysqli_fetch_array($query)){ 
				echo listing_annonce($res['id'],$i,$nbr_annonce,$mysql_link);
				$i++;
			} 
			
			?>
			
			<?php	
			
			//Pager
			$exist = nbrcontent("m_editorial","id_rubrique","19","id_cat",$_GET['id_cat'],"",$mysql_link);
			echo $pager = pager($exist,$par_page,$p,"","","id_cat",$_GET['id_cat'],$param3,$valeur3,$param4,$valeur4,$param5,$valeur5); 
						
			?>

			</div>
			
		</div>
			
	<?php require("../lib/include/n_i-footer.php") ?>	

</div>
</body>

</html>