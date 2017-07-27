<?php 
$rubrique = 14;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/n_f-pager.php");

$no_sky=1;
$no_photo=1;


$req_introduction = "SELECT titre, presentation FROM m_rubrique WHERE id= 14";
$query_introduction = mysqli_query($mysql_link,$req_introduction);
$res_introduction = mysqli_fetch_array($query_introduction);

?>



<?php require("../lib/include/n_i-meta.php"); ?>	

<title>L'annuraire du business surf !</title>
<meta name="description" content="<?php echo strip_tags($res_introduction['presentation']);?>" />
<meta name="robots" content="index,follow">
		
</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
    <?php echo fil_ariance("Accueil","../",rubrique(14,$mysql_link),".","","","",""); ?>

    <?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="line">
			

			<div class="line bgGrisClair pa2 mb2 phone-hidden">
				<h1 class="h2-like m-reset"><?php echo $res_introduction['titre']; ?></h1>
				<?php echo $res_introduction['presentation'];?>
			</div>	
			
			<?php
			$req = "SELECT * FROM m_cat WHERE id_rubrique= 14 ORDER BY id ASC";
			$query = mysqli_query($mysql_link,$req);
			
			$tabLienVoir = array("Consulter tous les shops","Consulter tous les shapers","Consulter toutes les écoles de surf","Consulter tous les surf camp");
			$tabLienAdd = array("Ajouter un surf shop","Ajouter un shaper","Ajouter une école de surf","Ajouter un surf camp");

			$i=0;
			while ($res = mysqli_fetch_array($query)){ 			
				
				if($i%2 != 1){echo '<section class="line grid mb2"><div class="grid2">';}
			?>
			
			
			<div>
				<div class="titreRubrique line mb1"><?php echo $res['nom']; ?></div>
				<h2 class="h3-like"><?php echo $res['presentation']; ?></h2>
				
				
				<?php 
				
				//AND client = 1 AND date_debut <= NOW() AND date_fin >= NOW()
				
				$req_annuaire = "SELECT * FROM m_annuaire WHERE id_cat =".$res['id']." ORDER BY rand() DESC LIMIT 0,9";
				$query_annuaire = mysqli_query($mysql_link,$req_annuaire);
				
				$z=1;
				while ($res_annuaire = mysqli_fetch_array($query_annuaire)){ 
					if($z == 1){echo '<section class="line grid mb2"><div class="grid3">';}

				?>
					<div><a href="<?php echo $res_annuaire['nom_fichier'].'--'.$res_annuaire['id'].'.html'; ?>" title="<?php echo $res_annuaire['titre']; ?>"><img class="borderGray" src="/lib/image/annuaire/<?php echo $res_annuaire['userfile1']; ?>" alt="<?php echo $res_annuaire['titre']; ?>" width="90" height="90" /></a></div>
				
				<?php 
				
				if($z == 3){echo '</div></section>'; $z=0;}
				$z++;
				
				} ?>
				
								
				<div class="bouton mt2 txtcenter"><a href="<?php echo $res['nom_fichier'].'-'.$res['id'].'-0-1.html'; ?>" title="<?php echo $tabLienVoir[$i]; ?>" class="fontWhite"><?php echo $tabLienVoir[$i]; ?></a></div>
				<div class="bouton mt2 txtcenter"><a href="ajout.php?id_cat=<?php echo $res['id']; ?>" title="<?php echo $tabLienAdd[$i]; ?>" class="fontWhite" rel="nofollow"><?php echo $tabLienAdd[$i]; ?></a></div>

			</div>	
			
			
			
			<?php 
			
			if($i%2 == 1){echo '</div></section>';}

			
			$i++;
			
			
			} ?>	

			</div>
			
		</div>
			
<?php require("../lib/include/n_i-footer.php") ?>
	

</div>
</body>

</html>