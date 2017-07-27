<?php 
$rubrique = 17;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");

$no_sky=1;

//on rÃ©rupÃ¨re les donnees
$req = "SELECT * FROM m_photo WHERE id = ".$_GET['id'];
$query = mysqli_query($mysql_link,$req);
$res = mysqli_fetch_array($query);

$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];



?>

<?php require("../lib/include/n_i-meta.php"); ?>	

<title>Photo - <?php echo $res['legende']; ?> - <?php echo categorie($res['id_cat'],$mysql_link); ?></title>	
<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/galerie-photo/'.$res['nom_fichier'].'--'.$res['id'].'-'.$res['id_cat'].'.html'; ?>" />
<meta name="description" content="<?php echo $res['legende']; ?>. Vous avez vu cette photo de <?php echo categorie($res['id_cat']); ?> ! Incroyable... " />


<meta property="og:title" content="Photo - <?php echo stripslashes($res['legende']); ?>" /> 
<meta property="og:description" content="<?php echo $res['legende']; ?>. Vous avez vu cette photo de <?php echo categorie($res['id_cat']); ?> ! Incroyable... " />  
<meta property="og:image" content="http://www.mango-surf.com/lib/image/photo/<?php echo $res['userfile2']; ?>" /> 


</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
    <?php echo fil_ariance("Accueil","../",rubrique(17,$mysql_link),".",tronquer(stripslashes($res['legende']),80),"","","",""); ?>


		<div class="mod wColCentre left">
		
			<article>
			

			
			
				<div class="mt2">
				

				
				<div itemscope itemtype="http://schema.org/ImageObject">
					
	
					<figure>
						
						<figcaption class="mb1">
						<?php if($res["titre"] != NULL){ ?>
						<h1 class="h2-like m-reset" itemprop="name"><?php echo stripslashes($res["titre"]); ?></h1>
						
						<?php }else{?>
						
						<h1 class="h2-like m-reset" itemprop="name"><?php echo stripslashes($res["legende"]); ?></h1>
						
						<?php } ?>
						
						<?php
						if (!empty($res["copyright"])){
							echo '<strong>© '.stripslashes($res["copyright"]).'</strong>';
						}else{
							echo $signature = '<span itemprop="author">© '.recupere_signature($res['id_photographe'],"1",$mysql_link).'</span>';
						}
						?>
							
						</figcaption>
						
						<?php if(!empty($res['corps'])){  ?>
						<div class="mb2"><?php echo stripslashes($res['corps']); ?></div>				
						<?php } ?>
						
						
						<img src="/lib/image/photo/<?php echo $res["userfile2"]; ?>" alt="<?php echo stripslashes($res["legende"]); ?>'" itemprop="contentURL" />
						
						
						</figure>
					
					
				
					
				</div>
				
				
				<div class="line mt1"><?php echo afficheTag($res["id_tag"],$mysql_link); ?></div>


				<?php if($res["no_menu"] != 1) { echo $menu_photo = photo_suivante($res["id"],$_GET["id_cat"],$_GET["s"],"","","1",$mysql_link); }?>		
				
				</div>
				

				

				
				
				<div class="alingJ clearB">
				<?php echo genere_commentaire($res["id_rubrique"],$res["id"],$_POST['ajout'],$_POST['nom'],$_POST['corps'],$res["nom_fichier"],$_GET['p'],"",$_GET['s'],$_POST['link'],$mysql_link); ?>
				<?php echo dernierephoto("id_cat",$res['id_cat'],"id",$res["id"],$option3,$valeur3,$option4,$valeur4,$mysql_link); ?>				
				</div>
			
			
			
			
			
			</article>


			
		</div>
    <?php require("../lib/include/n_i-partie-droite.php") ?>

    <?php require("../lib/include/n_i-footer.php") ?>


</div>
</body>

</html>