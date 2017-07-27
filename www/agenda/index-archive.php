<?php 
$rubrique = 16;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/n_f-pager.php");





//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 0)){
	$p = 1; 
}else{
	$p = $_GET['p'];
} 

$par_page = 28;


if( (!empty($_GET['annee_archive'])) AND ($_GET['annee_archive'] != date('Y')) ){
	$annee_archive = $_GET['annee_archive'];
	$req = "SELECT * FROM m_agenda WHERE en_ligne = 1 AND ((date_debut > '".$annee_archive."-01-01') AND (date_debut < '".$annee_archive."-12-31'))"; 
}else{
	$annee_archive = date('Y');
	$req = "SELECT * FROM m_agenda WHERE en_ligne = 1 AND date_debut < NOW() AND (date_debut > '".$annee_archive."-01-01')"; 
}


$req .= " ORDER BY date_debut ASC LIMIT ".(($p-1)*$par_page).",".$par_page;
$query = mysqli_query($mysql_link,$req);
$nbr_agenda = mysqli_num_rows($query)
?>



<?php require("../lib/include/n_i-meta.php"); ?>	

<title>Les archives des manifestations - <?php echo $annee_archive; ?></title>

<meta name="description" content="Découvrez les archives des manifestations de la glisse de l'année <?php echo $annee_archive; ?>" />
</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
    <?php echo fil_ariance("Accueil","../",rubrique(16,$mysql_link),".","Archives","index-archive.php",$annee_archive,""); ?>


	<?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="line">
			

			<?php
			?>
			
			<div class="line bgGrisClair pa2 mb2 phone-hidden">
			
			<h1 class="h2-like m-reset">Rechercher une manifestation archivée</h1>
			Rechercher une manifestation archivée</h1>
			Vous souhaitez retrouver un évènement dans l'<strong>univers de la glisse</strong> qui s'est déroulé en 2009 ? Avec les archives de l'<strong>agenda du surf</strong>, nous vous proposons de vous remémorer une manifestation !
			</div>
			
			<section class="line grid mb2 phone-hidden">
				<div class="grid8">

				<?php
				$i=1;
				$anne_en_cours = date('Y');
							
							
				for($i = $anne_en_cours; $i >= 2007; $i--){
						
				if($_GET['annee_archive'] == $i){
					$hover='bgBlack';
				}elseif(($anne_en_cours == $i) AND (empty($_GET['annee_archive']))){
					$hover='bgBlack';
				}else{
					$hover='bgRed';
				}
	
				?>
				
				<div class="mod"><li class="txt center inbl left pa1 mr05 <?php echo $hover; ?>"><a href="?annee_archive=<?php echo $i; ?>" title="Archive <?php echo $i; ?>" class="fontWhite" ><?php echo $i; ?></a></li></div>

						
				<?php $hover=""; }	?>
	
				</div>
			</section>

			
	
			<?php 
			
			$i = "";
			$mois_courrant = "";

			while ($res = mysqli_fetch_array($query)){ 

				$mois_entier = array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","septembre","Octobre","Novembre","Décembre");
				
				if((!empty($_GET['mois_menu'])) AND (empty($i))){
					$mois = $mois_entier[$_GET['mois_menu']-1];
				}elseif($mois_courrant != $res['mois']){
					$mois = $mois_entier[$res['mois']-1];
				}else{
					$mois = "";
				}
				
				if (!empty($mois)){
					echo listing_agenda($res['id'],$i,$mois,$mysql_link);
					$i++;
				}
					
					echo listing_agenda($res['id'],$i,"",$mysql_link);
				
				
				
				
				$mois_courrant = $res['mois'];
				$mois_marge = "";	
				$i++;
				
			} 
			
			
			if(empty($nbr_agenda)){
				echo "<div>Aucune manifestation n'a été archivée pour l'année ".$annee_archive."Nous vous invitons à parcourir les autres années via le menu ci-dessus !</div>";
			}

			
			?>
			
			
			<?php	
			
			//Pager
			
			if( (!empty($_GET['annee_archive'])) AND ($_GET['annee_archive'] != date('Y')) ){
				$exist = nbrcontent("m_agenda","en_ligne","1","",""," AND ((date_debut > '".$annee_archive."-01-01') AND (date_debut < '".$annee_archive."-12-31'))",$mysql_link);
			}else{
				$exist = nbrcontent("m_agenda","en_ligne","1","",""," AND date_debut < NOW() AND (date_debut > '".$annee_archive."-01-01')",$mysql_link);
			}
			
			
			echo $pager = pager($exist,$par_page,$p,"annee_archive",$annee_archive,"","",$param3,$valeur3,$param4,$valeur4,$param5,$valeur5); 
						
			?>

			</div>
			
		</div>
		
		<?php require("../lib/include/n_i-footer.php") ?>

	

</div>
</body>

</html>