<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/f-formulaire.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/f-upload-fichier.php");
require("../../lib/fonction/f-nom-fichier.php");



if(!empty($_POST['corps'])){

	//on explode les mots clés
	$mots_cles = explode(",",$_POST['corps']);
	
	//mot clés intégrés	
	$x="";
	
	//mots clés refusés
	$y="";
	
	//mots clés traités
	$z="";

	
	foreach($mots_cles as $mc){
		
		//ZONE A COMMENTER POUR UN IMPORT INITIALE OU NOUS SOMMES CERTAINS DE L'UNICITE DES MOTS CLES
		
		/*On teste pour savoir s'il existe un mot clé similaire*/
		$decoupe_mc = explode(" ",$mc);
		$nbr_ligne = count($decoupe_mc);

			$req_exist = "SELECT nom FROM m_tag WHERE (id_cat = ".$_POST['id_cat'].") AND (";
			$i=1;
			
			foreach($decoupe_mc as $dmc){
				
				$req_exist .= "(nom LIKE '%".$dmc."%')";
	
				$mot_cle_tempo .= clean_text($dmc);
				if($nbr_ligne != $i) $mot_cle_tempo .= " - ";
				if ($i != $nbr_ligne)$req_exist .= " OR ";	
				$i++;
			
			}
			
			$req_exist .= ") AND id_rubrique = 18";
		
		if(empty($_POST['force_ajout'])){	
			$query_exist = mysqli_query($mysql_link,$req_exist);
			$nbr_exist = mysqli_num_rows($query_exist);
		}
		
		//FIN DE ZONE A COMMENTER POUR UN IMPORT INITIALE OU NOUS SOMMES CERTAINS DE L'UNICITE DES MOTS CLES

		
		if(!empty($nbr_exist)){
			$mc_deja_en_ligne .= " ".$mc." - ";
			$y++;
		}else{
		
			// on prépare le nom du fichier
			$nom_fichier = prepare_url(filtre_url(nom_fichier_define($mc))); 

			//On intègre le mot clé
			$action_requette = "INSERT INTO";
			$last_id = last_id("m_tag",$mysql_link);
			
			$req = $action_requette." m_tag SET ";
	
			$req .= "id =\"".$last_id."\" ";
			$req .= ",id_rubrique =18";
			$req .= ",id_cat =\"".$_POST['id_cat']."\" ";
			$req .= ",nom  =\"".addslashes(trim($mc))."\" ";	
			$req .= ",mot_cle  =\"".addslashes(trim($mot_cle_tempo))."\" ";
			
				/*On teste si on a du contenu pour mettre la page en ligne*/
				$req_news = "SELECT * FROM m_editorial WHERE id_rubrique IN (1,2,4,6,7,8) AND ((titre LIKE '%".trim($mc)."%') OR (chapeau LIKE '%".trim($mc)."%'))";
				$query_news = mysqli_query($mysql_link,$req_news);
				$nbr_news = mysqli_num_rows($query_news);
				
				if(!empty($nbr_news)){
					$req .= ",en_ligne  = 1";
				}else{
					$req .= ",en_ligne  = 0";
				}
				
			/*On teste si on a du contenu pour mettre la page en ligne*/

			
			$req .= ",nom_fichier  =\"".$nom_fichier."\" ";
				
			$query = mysqli_query($mysql_link,$req);
			
			$mc_integrer .= $mc." - ";
			$x++;
		}
	
	$z++;
	$mot_cle_tempo="";
	$mc="";
	}
}


?>



<?php require("../../lib/include/n_i-meta.php"); ?>	

<title>Tag - Back Office</title>	
		
		
</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Tag - Back Office;</div>
			<div class="content bloc_arrondie">
			<?php echo $ariane = fil_ariance("admin","../","Tag","index.php?id_rubrique=".$_GET['id_rubrique'],"Visualiser","","",""); ?>


			<h1>Information sur l'import des mots clés</h1>
			
				<div class="alingJ clearB">
			
				
				<p>
				
				<?php if(!empty($x)){ ?>
				
				<strong>Les mots clés qui ont été importés en BDD : </strong><br /><br />
				<?php echo $mc_integrer; ?><br /><br />
				
				<?php } ?>
				
				
				<?php if(!empty($y)){ ?>
				
				<strong>Les mots clés qui n'ont pas été importés en BDD : </strong><br /><br />
				<?php echo $mc_deja_en_ligne; ?><br /><br />
				
				<?php } ?>
				
				Nombre total de mots clés traité : <?php echo $z; ?><br /><br />

				Nombre total de mots clés intégré : <?php echo $x; ?><br />
				Nombre total de mots clés qui ont échoués : <?php echo $y; ?>
				</p>
				
				</div>	
				
				
				<section class="grid mt2">
					<div class="grid2">
						<div><div class="bouton txtcenter"><a class="fontWhite" href="ajout-massif.php" title="Nouvel import">Nouvel import</a></div></div>
						<div><div class="bouton txtcenter"><a class="fontWhite" href="index.php?id_rubrique=18" title="Valider">Valider</a></div></div>
					</div>
				</section>		

			
				
			
			</div>
			
		</div>
			
<?php require("../../lib/include/n_i-footer.php") ?>	
	

</div>
</body>

</html>