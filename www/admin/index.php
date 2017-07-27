<?php 
$admin = true;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");

$no_sky = 1;
$no_photo = 1;
?>



<?php require("../lib/include/n_i-meta.php") ?>	

<title>-Bienvenue sur l'administration de mango-surf.com --</title>	
		
</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb2">Bienvenue sur l'administration !</div>
		
		<section class="line mb2 grid">
			<div class="grid4">
			
				<!-- NEWS -->
				<div>
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_editorial","id_rubrique","1","","","",$mysql_link); ?> News</div>
					<a href="editorial/index.php?id_rubrique=1" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="editorial/ajout.php?id_rubrique=1" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>
				</div>
				<!-- NEWS -->
				
				<!-- VIDEO -->
				<div>
				
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_editorial","id_rubrique","9","","","",$mysql_link); ?> Vidéos</div>
					<a href="editorial/index.php?id_rubrique=9" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="editorial/ajout.php?id_rubrique=9" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>
				</div>
				<!-- VIDEO -->
				
				<!-- PHOTO -->
				<div>
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_photo","id_rubrique","17","en_ligne","1","",$mysql_link); ?> Photos</div>
					<a href="photo/index.php?id_rubrique=17" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="photo/ajout.php?id_rubrique=17" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>


				</div>
				<!-- PHOTO -->
				
				<!-- SHOPPING -->
				<div>
				
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_shopping","id_rubrique","15","","","",$mysql_link); ?> Produits</div>
					<a href="shopping/index.php?id_rubrique=15" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="shopping/ajout.php?id_rubrique=15" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>
				</div>
				<!-- SHOPPING -->
				
			</div>
		</section>
		
		
		<section class="line mb2 grid">
			<div class="grid4">
			
				<!-- INTERVIEW -->
				<div>
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_editorial","id_rubrique","2","","","",$mysql_link); ?> Interviews</div>
					<a href="editorial/index.php?id_rubrique=2" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="editorial/ajout.php?id_rubrique=2" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>
				</div>
				<!-- INTERVIEW -->
				
				<!-- CULTURE -->
				<div>
				
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_editorial","id_rubrique","5","","","",$mysql_link); ?> Culture</div>
					<a href="editorial/index.php?id_rubrique=5" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="editorial/ajout.php?id_rubrique=5" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>
				</div>
				<!-- CULTURE -->
			
				<!-- TRIP SURF -->
				<div>
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_editorial","id_rubrique","3","","","",$mysql_link); ?> Trips surf</div>
					<a href="editorial/index.php?id_rubrique=3" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="editorial/ajout.php?id_rubrique=3" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>
				</div>
				<!-- TRIP SURF -->

				<!-- ACTU LOCALE -->
				<div>
				
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_editorial","id_rubrique","7","en_ligne","1","",$mysql_link); ?> Locales</div>
					<a href="editorial/index.php?id_rubrique=7" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="editorial/ajout.php?id_rubrique=7" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>
					
					<?php 
					
					$nbr2 = nbrcontent("m_editorial","id_rubrique","7","en_ligne","2","",$mysql_link);
					
					if ($nbr2 != NULL){
					
					?>	
					<a href="editorial/index.php?id_rubrique=7&en_ligne=2" title="Voir la liste"><div class="bouton mb05"><?php echo $nbr2; ?> à valider</div></a>

					<?php
					}
					?>
				
				</div>
				<!-- ACTU LOCALE -->
			</div>
		</section>
		
		
		<section class="line mb2 grid">
			<div class="grid4">
								
				<!-- SHOP -->
				<div>
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_annuaire","id_cat","26","en_ligne","1","",$mysql_link); ?> Shops</div>
					<a href="annuaire/index.php?id_cat=26" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="annuaire/ajout.php?id_cat=26" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>
					
					<?php 
					
					$nbr2 = nbrcontent("m_annuaire","id_cat","26","en_ligne","2","",$mysql_link);;
					
					if ($nbr2 != NULL){
					
					?>	
					<a href="annuaire/index.php?id_cat=26&en_ligne=2" title="Voir la liste"><div class="bouton mb05"><?php echo $nbr2; ?> à valider</div></a>

					<?php
					}
					?>
				</div>
				<!-- SHOP -->
				
				<!-- SCHOOL -->
				<div>
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_annuaire","id_cat","28","en_ligne","1","",$mysql_link); ?> Schools</div>
					<a href="annuaire/index.php?id_cat=28" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="annuaire/ajout.php?id_cat=28" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>
					
					<?php 
					
					$nbr2 = nbrcontent("m_annuaire","id_cat","28","en_ligne","2","",$mysql_link);;
					
					if ($nbr2 != NULL){
					
					?>	
					<a href="annuaire/index.php?id_cat=28&en_ligne=2" title="Voir la liste"><div class="bouton mb05"><?php echo $nbr2; ?> à valider</div></a>

					<?php
					}
					?>
				</div>
				<!-- SCHOOL -->
				
				<!-- SHAPER -->
				<div>
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_annuaire","id_cat","27","en_ligne","1","",$mysql_link); ?> Shapers</div>
					<a href="annuaire/index.php?id_cat=27" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="annuaire/ajout.php?id_cat=27" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>
					
					<?php 
					
					$nbr2 = nbrcontent("m_annuaire","id_cat","27","en_ligne","2","",$mysql_link);;
					
					if ($nbr2 != NULL){
					
					?>	
					<a href="annuaire/index.php?id_cat=27&en_ligne=2" title="Voir la liste"><div class="bouton mb05"><?php echo $nbr2; ?> à valider</div></a>

					<?php
					}
					?>
				</div>
				<!-- SHAPER -->
				
				<!-- CAMP -->
				<div>
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_annuaire","id_cat","29","en_ligne","1","",$mysql_link); ?> Camps</div>
					<a href="annuaire/index.php?id_cat=29" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="annuaire/ajout.php?id_cat=29" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>
					
					<?php 
					
					$nbr2 = nbrcontent("m_annuaire","id_cat","29","en_ligne","2","",$mysql_link);;
					
					if ($nbr2 != NULL){
					
					?>	
					<a href="annuaire/index.php?id_cat=29&en_ligne=2" title="Voir la liste"><div class="bouton mb05"><?php echo $nbr2; ?> à valider</div></a>

					<?php
					}
					?>
				</div>
				<!-- CAMP -->
				
			</div>
		</section>
		
		
		
		<section class="line mb2 grid">
			<div class="grid4">
				
				<!-- AGENDA -->
				<div>
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_agenda","id_rubrique","16","en_ligne","1","",$mysql_link); ?> Evenements</div>
					<a href="agenda/index.php?id_rubrique=16" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="agenda/ajout.php?id_rubrique=16" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>
					
					<?php 
					
					$nbr2 = nbrcontent("m_agenda","id_rubrique","16","en_ligne","2","",$mysql_link);
					
					if ($nbr2 != NULL){
					
					?>	
					<a href="agenda/index.php?id_rubrique=16&en_ligne=2" title="Voir la liste"><div class="bouton mb05"><?php echo $nbr2; ?> à valider</div></a>

					<?php
					}
					?>
					
				</div>
				<!-- AGENDA -->
				
				<!-- ANNONCE -->
				<div>
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_editorial","id_rubrique","19","en_ligne","1","",$mysql_link); ?> Annonces</div>
					<a href="editorial/index.php?id_rubrique=19" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="editorial/ajout.php?id_rubrique=19" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>
					
					<?php 
					
					$nbr2 = nbrcontent("m_editorial","id_rubrique","19","en_ligne","2","",$mysql_link);
					
					if ($nbr2 != NULL){
					
					?>	
					<a href="editorial/index.php?id_rubrique=19&en_ligne=2" title="Voir la liste"><div class="bouton mb05"><?php echo $nbr2; ?> à valider</div></a>

					<?php
					}
					?>
				</div>
				<!-- ANNONCE -->
				
				
				<!-- SESSION -->
				<div>
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_editorial","id_rubrique","8","en_ligne","1","",$mysql_link); ?> Sessions</div>
					<a href="editorial/index.php?id_rubrique=8" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="editorial/ajout.php?id_rubrique=8" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>
					
					<?php 
					
					$nbr2 = nbrcontent("m_editorial","id_rubrique","8","en_ligne","2","",$mysql_link);
					
					if ($nbr2 != NULL){
					
					?>	
					<a href="editorial/index.php?id_rubrique=8&en_ligne=2" title="Voir la liste"><div class="bouton mb05"><?php echo $nbr2; ?> à valider</div></a>

					<?php
					}
					?>
					
					
				</div>
				<!-- SESSION -->
							
				<!-- LEXIQUE -->
				<div>
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_editorial","id_rubrique","10","","","",$mysql_link); ?> Définitions</div>
					<a href="editorial/index.php?id_rubrique=10" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="editorial/ajout.php?id_rubrique=10" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>
				</div>
				<!-- LEXIQUE -->

				
				
				</div>
		</section>
		
		
		<section class="line mb2 grid">
			<div class="grid4">
			
				
				<!-- COMMENTAIRE -->
				<div>
				
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_commentaire","etat","1","","","",$mysql_link); ?> Comment</div>
					<a href="commentaire/index.php?etat=1" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>	
					<?php 
					
					$nbrC = nbrcontent("m_commentaire","etat","0","","","",$mysql_link);
					
					if ($nbrC != NULL){
					
					?>	
					<a href="commentaire/index.php?etat=0" title="Voir la liste"><div class="bouton mb05"><?php echo $nbrC; ?> à valider</div></a>

					<?php
					}
					?>
				
				</div>
				<!-- COMMENTAIRE -->
				
				
				<!-- PARTENAIRE -->
				<div>
					<div class="titreRubrique mb1">Partenaires</div>
					<a href="partenariat/index.php?id_rubrique=23" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="partenariat/ajout.php?id_rubrique=23" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>
				</div>
				<!-- PARTENAIRE -->
				
				<!-- CONFIGURATION -->
				<div>
				
					<div class="titreRubrique mb1">Configuration</div>
					<a href="configuration/index.php?etat=1" title="Voir la liste"><div class="bouton mb05">Rubrique</div></a>
					<a href="newsletter/index.php" title="Ajouter"><div class="bouton mb05">Newsletter</div></a>
				</div>
				<!-- CONFIGURATION -->

				<!-- TAG -->
				<div>
					<div class="titreRubrique mb1"><?php echo $nbr = nbrcontent("m_tag","id_rubrique","18","","","",$mysql_link); ?> Tags</div>
					<a href="tag/index.php?id_rubrique=18" title="Voir la liste"><div class="bouton mb05">Voir la liste</div></a>
					<a href="tag/ajout.php?id_rubrique=18" title="Ajouter"><div class="bouton mb05">Ajouter</div></a>
					<a href="tag/ajout-massif.php?id_rubrique=18" title="Ajouter"><div class="bouton mb05">Ajout massif</div></a>
				</div>
				<!-- TAG -->
			</div>
		</section>

		</div>
	</section>				

	
	

	
	</div>
			
	<?php require("../lib/include/n_i-footer.php") ?>

</div>
</body>

</html>