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

if((!empty($_GET['mois_menu'])) OR (!empty($_GET['p']))){
	if(!empty($_GET['mois_menu'])){
		$mois_title = " - ".recupere_mois($_GET['mois_menu'],$mysql_link);
		$mois_ariane = recupere_mois($_GET['mois_menu'],$mysql_link);
	}
}

$par_page = 30;


$req = "SELECT * FROM m_agenda WHERE en_ligne = 1 AND date_debut > NOW()";

	if(!empty($_GET['mois_menu'])){
		$req .= " AND mois = ".$_GET['mois_menu']; 
	}

$req .= " ORDER BY date_debut ASC LIMIT ".(($p-1)*$par_page).",".$par_page;
$query = mysqli_query($mysql_link,$req);
$nbr_agenda = mysqli_num_rows($query);


$req_introduction = "SELECT titre, presentation FROM m_rubrique WHERE id= 16";
$query_introduction = mysqli_query($mysql_link,$req_introduction);
$res_introduction = mysqli_fetch_array($query_introduction);

?>



<?php require("../lib/include/n_i-meta.php"); ?>	

<title>L'agenda du surf <?php echo $mois_title; ?></title>

<meta name="description" content="<?php echo strip_tags($res_introduction['presentation']);?>" />
</head>
<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
    <?php echo fil_ariance("Accueil","../","Agenda",".",$mois_ariane,"","",""); ?>


    <?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="line">
			

			<?php
			?>
			
			<div class="line bgGrisClair pa2 mb2 phone-hidden">
					<h1 class="h2-like m-reset"><?php echo $res_introduction['titre']; ?></h1>
					<?php echo $res_introduction['presentation'];?>. <a href="index-archive.php" title="Consulter les archives">Voir les archives</a>
			</div>
			
			<a href="ajout.php" title="Poster une manifestation" rel="nofollow"><div class="phone-hidden bouton txtcenter">Poster une manifestation</div></a> 
			
				
			<section class="line mb2 txtcenter phone-hidden">
				<?php
				$i=1;
				$mois_en_cours = date('m');
				$mois = array(1 => "Jan",2 =>"Fev",3 =>"Mar",4 =>"Avr",5 =>"Mai",6 =>"Jui",7 =>"Jui",8 =>"Aou",9 =>"Sep",10 =>"Oct",11 =>"Nov",12 =>"Dec");			
						
						
						
				for($i = 0, $m = str_replace("0","",$mois_en_cours); $i < 12; $i++, $m++){
						
				if($m > 12) $m=1;
						
				if($_GET['mois_menu'] == $m){
					$hover='bgBlack';
				}elseif(($mois_en_cours == $m) AND (empty($_GET['mois_menu']))){
					$hover='bgBlack';
				}else{
					$hover='bgRed';
				}
				?>
						
				<li class="inbl center inbl left pa1 mr1 <?php echo $hover; ?>"><a class="fontWhite" href="?mois_menu=<?php echo $m; ?>" <?php echo $hover; ?> title="<?php echo $mois[$m]; ?>" ><?php echo $mois[$m]; ?></a></li>
					
				<?php $hover=""; }	?>
			
			</section>
			


			
	
			<?php 
			
			$i = 1;
			$mois_courrant = "";
			
			while ($res = mysqli_fetch_array($query)){ 

				if($i==4) $i=1;
				
				$mois_entier = array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","septembre","Octobre","Novembre","Décembre");
				
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
				echo "<div class='txtcenter lien mt3 mb2'><strong>Aucune manifestation n'a été enregistrée à cette période</strong><br /><br />
				<a href='ajout.php' title='Poster une manifestation' rel='nofollow'><strong>Soyer le premier à poster un évènement !</strong></a></div>";
			}
			
			?>
			
			
			<?php	
			
			//Pager
			$exist = nbrcontent("m_agenda","en_ligne","1","mois",$_GET['mois_menu']," AND date_debut > NOW()",$mysql_link);
			echo $pager = pager($exist,$par_page,$p,"mois",$_GET['mois_menu'],"","",$param3,$valeur3,$param4,$valeur4,$param5,$valeur5); 
						
			?>

			</div>
			
		</div>
			<?php require("../lib/include/n_i-footer.php") ?>


</div>
	
</body>

</html>