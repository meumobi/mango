<?php 
$rubrique = 15;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");

//Pour ne pas afficher le bloc photo + sky + business dans la sideBar
$no_sky = 1;


//on rÃ©rupÃ¨re les donnees
$res = donnee("m_hawaii_surf","id",$_GET['id'],"","",$mysql_link);

?>



<?php require("../../lib/include/n_i-meta.php"); ?>	

<title><?php echo $res['titre'].' - '.marque($res['id_marque'],$mysql_link); ?></title>	
<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/shopping/'.$res['nom_fichier'].'--'.$res['id'].'.html'; ?>" />
<meta name="description" content="<?php echo stripslashes(tronquer($res['corps'],150)); ?>" />

<meta property="og:title" content="Shop'in - <?php echo stripslashes($res['titre']); ?>" /> 
<meta property="og:description" content="<?php echo stripslashes(tronquer($res['corps'],150)); ?>" />  
<meta property="og:image" content="http://www.mango-surf.com/lib/image/shopping/<?php echo $res['userfile2']; ?>" /> 
	
</head>

<body>

<div class="wSite">

	<?php require("../../lib/include/n_i-header.php"); ?>	


	<?php require("../../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="titreRubrique line mb1"><?php echo rubrique(15,$mysql_link); ?></div>
			<article itemscope itemtype="http://schema.org/Product">
			
			<?php echo fil_ariance("Accueil","../",rubrique(15,$mysql_link),".",tronquer(stripslashes($res['titre']),80),"","",""); ?>
			<?php //echo share("","",1);?>

			
			<h1 itemprop="name"><?php echo stripslashes($res['titre']); ?></h1>
			
			<div class="big">
			
				<?php echo $image = image($res['userfile2'],"right borderGray","","","","shopping","","",$mysql_link); ?>
				<?php if(!empty($res['corps'])){ ?><?php echo "<span itemprop='description'>".stripslashes(nl2br($res['corps']))."</span>"; ?><?php } ?>
				
				<p>
				<?php if(!empty($res['id_marque'])){ ?>
				<strong>Marque : <a href="marque/<?php echo Urlmarque($res['id_marque'],$mysql_link).'-'.$res['id_marque'].'-1.html'; ?>" title="<?php echo marque($res['id_marque'],$mysql_link); ?>"><span itemprop="brand"><?php echo $marque = marque($res['id_marque'],$mysql_link); ?></span></a></strong><br />
				
				<?php } ?>
				<?php if(!empty($res['prix'])){ ?>
					<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
						<strong>Prix : <span itemprop="price"><?php echo $res['prix']; ?></span> euros</strong><br />
					</span>
				<?php } ?>	
				
				<?php if($res['url_shop']){ ?>
				
					<form method="POST" action="../vive-le-surf/" method="POST" target="_blank">
						<input type="hidden" name="id" id="id" value="<?php echo $res['id']; ?>" maxlength="180" size=""  />				
						<input type="submit" value="Acheter en ligne" class="bouton mt2" />				
					</form>				
				
				<?php } ?>
				
				
				
				</p>
			</div>
				
				
				
				
				<div>
				
				<?php 
				if(!empty($res['nom_lien'])){ 
					$lien = lien($res['nom_lien'],$res['url_lien'],"_blank","",""); 
					echo '<p>'.$lien.'</p>';
				}
				?>
				
				<?php 
				if(!empty($res['titre_news'])){ 
					$plusdenews = plusdecontenu($res['titre_news'],$res['id_news'],"m_shopping",$mysql_link);
					echo $plusdenews;
				}
				?>
				
				<?php 
				if(!empty($res['titre_video'])){ 
					$plusdevideo = plusdecontenu($res['titre_video'],$res['id_video'],"m_shopping",$mysql_link);
					echo $plusdevideo;
				}
				?>
				
				</div>
				<?php echo genere_commentaire($res["id_rubrique"],$res["id"],$_POST['ajout'],$_POST['nom'],$_POST['corps'],$res["nom_fichier"],$_GET['p'],"","",$_POST['link'],$mysql_link); ?>
			
			</article>
			
		</div>
		
		<?php require("../../lib/include/n_i-footer.php") ?>	

	

</div>
</body>

</html>